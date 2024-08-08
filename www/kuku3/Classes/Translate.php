<?php 

namespace Kuku3\Classes;

use Kuku3\Classes\Security;
use Kuku3\Classes\ToastException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Flight;
use DateTime;
use PDO;
use Kuku3\Classes\VisitorInfo;
use Kuku3\Classes\HtmxResponse;

class Translate 
{
	private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

	public function test() {
		HtmxResponse::renderNotification('testing');
	}
	
	function googleTranslate(string $sourceLang = 'fi', string $targetLang = 'en') {
		Security::authCheck();

		$text = Flight::request()->data->source;
		$url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl={$sourceLang}&tl={$targetLang}&dt=t&q=" . urlencode($text);
	
        $response = $this->client->request('GET', $url);
		$responseBody = $response->getBody()->getContents();
	
		// Google returns a complex JSON, we need to extract the translated text
		$translatedTextArray = json_decode($responseBody, true);
		// $translatedText = $translatedTextArray[0][0][0];

		$translatedText = '';
		if (isset($translatedTextArray[0])) {
			foreach ($translatedTextArray[0] as $sentence) {
				$translatedText .= $sentence[0];
			}
		}
	
		Flight::htmxResponse()->sendHtml($translatedText);
	}

	function newTranslation() {
		Security::authCheck();
		Flight::latte()->render('new-translation.latte');
	}

	public function saveTranslation() {
		try {
			Security::authCheck();

			$source = Flight::request()->data->source;
			$translation = Flight::request()->data->translation;
			
			if (empty($source) || empty($translation)) {
				throw new \Exception('Source or translation must not be empty');
			}

			$sourceSentences = explode("\n", $source);
			$translationSentences = explode("\n", $translation);

			if (count($sourceSentences) !== count($translationSentences)) {
				throw new \Exception('Source and translation must have equal line length');
			}

			$dbFormattedDate = $this->extractAndFormatDate($sourceSentences[0]);

			$db = Flight::db();
			$sql = 'SELECT MAX(timestamp) FROM translations';
			$maxDate = $db->fetchField($sql); // fetchField pulls the first field from the query
			
			if ($maxDate == $dbFormattedDate) {
				throw new \Exception('You can only save a translation once per day');
			}

			$combined_sentences = array_combine(array_map('trim', $sourceSentences), array_map('trim', $translationSentences));
			$db = Flight::db();

			foreach($combined_sentences as $sourceSentence => $translationSentence) {
				$db->runQuery("INSERT INTO translations (timestamp, source_line, translation_line) VALUES (?, ?, ?)", [$dbFormattedDate,  $sourceSentence, $translationSentence ]);
			}

			Flight::htmxResponse()->sendHtml('Saved');	
		} catch (\Exception $e) {
			new ToastException($e);
		}

	}

	private function extractAndFormatDate($sentence) {
		// Define regex patterns
		$patterns = [
			'/(\d{1,2})-(\d{1,2})-(\d{4})/',
			'/(\d{1,2}).(\d{1,2}).(\d{4})/'
		];

		foreach ($patterns as $pattern) {
			if (preg_match($pattern, $sentence, $matches)) {
				$day = $matches[1];
				$month = $matches[2];
				$year = $matches[3];
				
				$date = DateTime::createFromFormat('d-m-Y', "$day-$month-$year");
				return $date->format('Y-m-d');
			}
		}

		// Last resort, return current date
		return date('Y-m-d');
	}

	public function getLatestPracticeData() {
		$db = Flight::db();
		
		$sql = 'SELECT * 
				FROM translations 
				WHERE timestamp = (
					SELECT MAX(timestamp) 
					FROM translations t2
					ORDER BY t2.id
				)';

		$latestTranslation = $db->fetchAll($sql);
		$questions = [];
		$questionId = 0;
		$uniqueWords = [];
		$skipTheTitle = true;

		foreach ($latestTranslation as $question) {
			if ($skipTheTitle) {
				$skipTheTitle = false;
				continue;
			}

			$wordId = 0;
			$tmp = [];

			// This data is used to render the question and answer
			$tmp = [
				'id' => $questionId,
				'native_phrase_array' => explode(' ', $question['translation_line']),
				'foreign_phrase_array' => explode(' ', $question['source_line']), // shuffle
				'native_phrase' => $question['translation_line'],
				'foreign_phrase' => $question['source_line'],
			];
			
			// This data is used to manage the selectable words
			foreach ($tmp['foreign_phrase_array'] as $key => $word) {
				$tmp['foreign_phrase_object'][$wordId]['id'] = $key;
				$tmp['foreign_phrase_object'][$wordId]['word'] = $word;
				$tmp['foreign_phrase_object'][$wordId]['hidden'] = false;
				$tmp['foreign_phrase_object'][$wordId]['width'] = 0;
				$tmp['foreign_phrase_object'][$wordId]['height'] = 0;
				if (!in_array($word, $uniqueWords) && preg_match('/^[a-zA-Z]+$/', $word)) {
					$uniqueWords[] = $word;
				}
				$wordId++;
			}

			$questions[$questionId] = $tmp;
			$questionId++;
		}

		// Add a random word from uniqueWords to foreign_phrase_object and shuffle
		foreach ($questions as &$question) {
			if (!empty($uniqueWords)) {
				$question['foreign_phrase_object'][] = [
					'id' => count($question['foreign_phrase_object']),
					'word' => $uniqueWords[array_rand($uniqueWords)],
					'hidden' => false,
					'width' => 0,
					'height' => 0
				];
			}

			shuffle($question['foreign_phrase_object']);
		}

		$json = json_encode($questions);
		return $json;
	}


	public function getLatestPractice() {
		Flight::latte()->render('practice.latte', [
			'questions' => $this->getLatestPracticeData(),
		]);
	}

	// The latest practice info you click to access the practice
	public function getLatestPracticeInfo() {
		$db = Flight::db();
		
		$sql = 'SELECT * 
				FROM translations 
				WHERE timestamp = (
					SELECT MAX(timestamp) 
					FROM translations t2
					ORDER BY t2.id
				)';

		$latestTranslation = $db->fetchAll($sql);
		$title = $latestTranslation[0]['source_line'] ?? '';

		VisitorInfo::insertVisitorInfo();
		Flight::latte()->render('practice-info.latte', [
			'title' => $title,
			'visitorTotal' => VisitorInfo::getTotalNumberOfVisitors(),
		]);
	}
	

	public function getTranslationByDate(string $paginationIndex) {
		// TODO: 
		// Query - GROUP BY date and give pagination index foreach date.
		// Show this to the user. When the user clicks, we can use the same query to lookup the date by pagination index.
		// Then query the translations table by that date.
	}

}


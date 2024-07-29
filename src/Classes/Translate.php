<?php 

namespace Kuku3\Classes;

use GuzzleHttp\Client;
use Kuku3\Classes\Security;
use Flight;
use PDO;

class Translate 
{
	private $client;

    public function __construct()
    {
		Security::authCheck();
        $this->client = new Client();
    }
	
	function googleTranslate(string $sourceLang = 'fi', string $targetLang = 'en') {
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
		Flight::latte()->render('new-translation.latte');
	}

	public function saveTranslation() {
		$source = Flight::request()->data->source;
		$translation = Flight::request()->data->translation;
		
		$sourceSentences = explode("\n", $source);
		$translationSentences = explode("\n", $translation);

		if (empty($sourceSentences) || empty($translationSentences)) {
			throw new \Exception('Source or translation must not be empty');
		}

		if (count($sourceSentences) !== count($translationSentences)) {
			throw new \Exception('Source and translation must have equal line length');
		}

		$db = Flight::db();
		$sql = 'SELECT MAX(timestamp) FROM translations';
		$maxDate = $db->fetchField($sql); // fetchField pulls the first field from the query
		$today = date('Y-m-d');
		
		if ($maxDate == $today) {
			throw new \Exception('You can only save a translation once per day');
		}

		$combined_sentences = array_combine(array_map('trim', $sourceSentences), array_map('trim', $translationSentences));
		$db = Flight::db();

		foreach($combined_sentences as $sourceSentence => $translationSentence) {
			$db->runQuery("INSERT INTO translations (source_line, translation_line) VALUES (?, ?)", [ $sourceSentence, $translationSentence ]);
		}
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
		Flight::latte()->render('practice.latte', ['questions' => $this->getLatestPracticeData()]);
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
		$title = $latestTranslation[0]['source_line'];

		Flight::latte()->render('practice-info.latte', ['title' => $title]);
	}


	public function getTranslationByDate(string $paginationIndex) {
		// TODO: 
		// Query group by date and give pagination index foreach date.
		// Show this to the user. when the user clicks, we can use the same query to lookup the date by pagination index.
		// Then query the translations table by that date.
	}

}


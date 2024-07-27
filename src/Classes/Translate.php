<?php 

namespace Kuku3\Classes;

use GuzzleHttp\Client;
use Flight;

class Translate 
{
	private $client;

    public function __construct()
    {
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
}


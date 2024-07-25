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
	
	function googleTranslate($text, $sourceLang = 'fi', $targetLang = 'en') {
		$url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl={$sourceLang}&tl={$targetLang}&dt=t&q=" . urlencode($text);
	
        $response = $this->client->request('GET', $url);
		$responseBody = $response->getBody()->getContents();
	
		// Google returns a complex JSON, we need to extract the translated text
		$translatedTextArray = json_decode($responseBody, true);
		$translatedText = $translatedTextArray[0][0][0];
	
		// return $translatedText;
		Flight::view()->assign('translatedText', $translatedText);
        Flight::view()->display('home.tpl');
	}

	function newTranslation() {
		Flight::view()->display('new-translation.tpl');		
	}
}


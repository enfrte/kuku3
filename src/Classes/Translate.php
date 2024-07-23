<?php 

namespace Kuku3\Classes;

use GuzzleHttp\Client;

class Translate 
{
	private $client;

    public function __construct()
    {
        $this->client = new Client();
    }
	
	function translate($text, $sourceLang = 'auto', $targetLang = 'en') {
		$url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl={$sourceLang}&tl={$targetLang}&dt=t&q=" . urlencode($text);
	
        $response = $this->client->request('GET', $url);
		$responseBody = $response->getBody()->getContents();
	
		// Google returns a complex JSON, we need to extract the translated text
		$translatedTextArray = json_decode($responseBody, true);
		$translatedText = $translatedTextArray[0][0][0];
	
		return $translatedText;
	}
	
}


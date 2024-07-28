<?php 

namespace Kuku3\Classes;

use GuzzleHttp\Client;
use DOMDocument;
use DOMXPath;
use Flight;
use Kuku3\Classes\Security;

class SelkoSuomiParser 
{
	private $client;

    public function __construct()
    {
        Security::authCheck();
        $this->client = new Client();
    }
	
	public function getLatestNews() {
        $url = 'https://yle.fi/selkouutiset';
        $response = $this->client->request('GET', $url);
		$responseBody = $response->getBody()->getContents();
		
		$doc = new DOMDocument();
        // @$doc->loadHTML($responseBody); // The @ suppresses warnings due to malformed HTML
        @$doc->loadHTML(mb_convert_encoding($responseBody, 'HTML-ENTITIES', 'UTF-8'));

        $xpath = new DOMXPath($doc);

        $content = [];

        // The date of the article
        $dateNode = $xpath->query('//article//h1[contains(@class, "yle__article__heading")]');
        if ($dateNode->length > 0) {
            $content[] = trim($dateNode->item(0)->nodeValue) . ".";
        }
        
        // Fetch the title (first .yle__article__paragraph)
        $titleNode = $xpath->query('//article//p[contains(@class, "yle__article__paragraph")][1]');
        if ($titleNode->length > 0) {
            $content[] = trim($titleNode->item(0)->nodeValue) . ".";
        }

        // Fetch subheadings (.yle__article__heading) and other paragraphs (.yle__article__paragraph)
        // $nodes = $xpath->query('//p[contains(@class, "yle__article__paragraph") or contains(@class, "yle__article__heading")]');
		$nodes = $xpath->query('//p[contains(@class, "yle__article__paragraph")] | //h2[contains(@class, "yle__article__heading")]');
        foreach ($nodes as $index => $node) {
            // Skip the first node if it is the title (already added)
            if ($index == 0 && strpos($node->getAttribute('class'), 'yle__article__paragraph')) {
                continue;
            }
            if (strpos($node->getAttribute('class'), 'yle__article__heading')) {
                $content[] = trim($node->nodeValue) . ".";
            }
            else {
                $content[] = trim($node->nodeValue);
            }
        }

        $contentToText = implode("\n", $content);
        Flight::htmxResponse()->sendHtml($contentToText);
	}

}

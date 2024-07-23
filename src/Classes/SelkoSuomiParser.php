<?php 

namespace Kuku3\Classes;

use GuzzleHttp\Client;
use DOMDocument;
use DOMXPath;

class SelkoSuomiParser 
{
	private $client;

    public function __construct()
    {
        $this->client = new Client();
    }
	
	function parse(string $url) {
        $response = $this->client->request('GET', $url);
		$responseBody = $response->getBody()->getContents();

		
		$doc = new DOMDocument();
        @$doc->loadHTML($responseBody); // The @ suppresses warnings due to malformed HTML
        $xpath = new DOMXPath($doc);

        $content = [];

        // Fetch the title (first .yle__article__paragraph)
        $titleNode = $xpath->query('//article//p[contains(@class, "yle__article__paragraph")][1]');
        if ($titleNode->length > 0) {
            $content[] = trim($titleNode->item(0)->nodeValue);
        }

        // Fetch subheadings (.yle__article__heading) and other paragraphs (.yle__article__paragraph)
        // $nodes = $xpath->query('//p[contains(@class, "yle__article__paragraph") or contains(@class, "yle__article__heading")]');
		$nodes = $xpath->query('//p[contains(@class, "yle__article__paragraph")] | //h2[contains(@class, "yle__article__heading")]');
        foreach ($nodes as $index => $node) {
            // Skip the first node if it is the title (already added)
            if ($index == 0 && strpos($node->getAttribute('class'), 'yle__article__paragraph')) {
                continue;
            }
            $content[] = trim($node->nodeValue);
        }

        return $content;
	}

}

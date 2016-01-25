<?php
namespace Controller;

use \W\Controller\Controller;
use Sunra\PhpSimple\HtmlDomParser;

class ScraperController extends Controller
{
	public function globalScraper()
	{
		
		// Target
		$url = "http://www.imdb.com/chart/moviemeter?ref_=nv_mv_mpm_7";
		
		// Switch the page in English
		$options = ['http' => [
		    'method'=>"GET",
		    'header'=>"Accept-language: en\r\n"
		]];
		$context = stream_context_create($options);

		// Open the file using the HTTP headers set above
		$content = file_get_contents($url, false, $context);

		// Create a new  domparser object stocked into "$html"
		$html = HtmlDomParser::str_get_html($content);

		// Find every link to single movie page inside the movies top page 
		foreach ( $html->find(".titleColumn a") as $href ) {
			//affichage des lien pour develloper à virer en temps et en heure

			$regIdMovie = '!tt\d{7}!';
			$urlMovie = $href->href;

			preg_match( $regIdMovie , $urlMovie , $matches );

			$link = "http://www.imdb.com/title/' . $matches[0] . '/";
		}

		
		// extraire chacune de ces url avec un foreach, et les passer chacune tour à tour dans la fonction pageScraper
		//pour en extraire l'ensemble des donnees du film
	}

	public function pageScraper()
	{
		//extraire toutes les donnees necessaires d'une page d'un film
	}


}

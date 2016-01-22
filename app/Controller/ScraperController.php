<?php
namespace Controller;

use \W\Controller\Controller;
use Sunra\PhpSimple\HtmlDomParser;

class ScraperController extends Controller
{
	public function globalScraper()
	{
		
		//on stocke l'url à scrapper dans une variable
		$url = "http://www.imdb.com/chart/moviemeter?ref_=nv_mv_mpm_7";
		//on empeche la page de passer a sa version francaise
		$opts = ['http' => [
		    'method'=>"GET",
		    'header'=>"Accept-language: en\r\n"
		]];

		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		$content = file_get_contents($url, false, $context);

		//Create a new  domparser object we stock into $html
		$html = HtmlDomParser::str_get_html($content);

		//find every link to single  movie page inside the movies top page 
		$page = $html->find(".titleColumn a");
		foreach ($page as $value) {

			echo $value->href;
		}

		
		// extraire chacune de ces url avec un foreach, et les passer chacune tour à tour dans la fonction pageScraper
		//pour en extraire l'ensemble des donnees du film
		echo 'bien arrivé';
	}

	public function pageScraper()
	{
		//extraire toutes les donnees necessaires d'une page d'un film
	}


}

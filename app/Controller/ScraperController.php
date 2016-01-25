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
		//recup tableau de la bdd movie par select all mettre en variable
		//si non inserage via le foreach
		foreach ($page as $link) {
		//interroge la  variablebdd si le film (imdbId) est deja present ou non
		//si deja present continue
			//affichage des lien pour develloper à virer en temps et en heure
			echo $link->href;
			echo '<br/>';
		}

		
		// extraire chacune de ces url avec un foreach, et les passer chacune tour à tour dans la fonction pageScraper
		//pour en extraire l'ensemble des donnees du film
		echo 'bien arrivé';
	}

	public function pageScraper($link)
	{
		//extraire toutes les donnees necessaires d'une page d'un film
	}


}

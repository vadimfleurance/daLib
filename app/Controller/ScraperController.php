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
			$regIdMovie = '!tt\d{7}!';
			$urlMovie = $href->href;

			preg_match( $regIdMovie , $urlMovie , $matches );

			$link = "http://www.imdb.com/title/' . $matches[0] . '/";
			$this->pageScraper($link);
		}

		
		// extraire chacune de ces url avec un foreach, et les passer chacune tour à tour dans la fonction pageScraper
		//pour en extraire l'ensemble des donnees du film
		//mais avant!!!!!!!!
		//recup tableau de la bdd movie par select all mettre en variable
		//interroge la  variablebdd si le film (imdbId) est deja present ou non
		//si deja present continue
	}


	public function pageScraper($link)

	{
		//extraire toutes les donnees necessaires d'une page d'un film
		//initialisation du tableau qui contiendra toutes les données du film
		$movie = ["title" => "", "synopsis" => "", "duration" => "", "year" => "", "imdbRef" => "", "imdbRating" => "", "cover" => "", "directors" => "", "writers" =>"", "stars" => "", "genres" => ""];
		//utilisation de la fonction trim pour supprimer les espaces en début et en fin de chaine
		$link = trim($link);

		// si l'url ou l'id passé a une syntaxe valide
		if (preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/$!", $link) || preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/\?.*!", $link) || preg_match("!^[t]{2}\d{7}$!", $link)){

			//vérifie si le texte passé est un id d'IMDb  (sans les slash autour) de type "ttxxxxxxx" ou les x sont des chiffres de 0 à 9 et le traite si c'est le cas
			if (preg_match("!^[t]{2}\d{7}$!", $link)){
				$link = "http://www.imdb.com/title/" . $link . "/";
			}

			//vérifie si le texte passé est une URL d'un film sur IMDb
			if (preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/$!", $link)){
				// $link = $link;
			}

			//vérifie si le texte passé est une URL avec des paramètres et supprime les paramètres si c'est le cas
			if(preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/\?.*!", $link)){
				$link = preg_replace("/\?.*/", "", $link);
			}

			//permet d'avoir le titre en anglais
			//création d'une entête HTTP
			$opts = ['http' => [
			    'method'=>"GET",
			    'header'=>"Accept-language: en\r\n"
			]];

			$context = stream_context_create($opts);

			// récupère le contenu html de l'url donnée en ajoutant à l'url l'entête HTTP créée plus haut
			$content = file_get_contents($url, false, $context);

			//crée un objet de la classe simple_html_dom et lui passe le contenu html de la page imdb
			$html = str_get_html($content);

			//récupération des différents champs
			//utilisation de la fonction trim pour supprimer les espaces en début et en fin de chaine

			//titre du film
			$title = trim($html->find('span[itemprop=name]',0)->plaintext);

			//synopsis
			$synopsisTmp = $html->find("p[itemprop=description]",0);
			if (!empty($synopsisTmp)){
				$movie["synopsis"] = trim($synopsisTmp->plaintext);
			}

			//durée
			$durationTmp = $html->find("time[itemprop=duration]",0);
			if (!empty($durationTmp)){
				$movie["duration"] = trim(str_replace(" min", "", $durationTmp->plaintext));
			}
			// $duration = trim(str_replace(" min", "", $html->find("time[itemprop=duration]",0)->plaintext));

			//année
			$yearTmp = $html->find(".header", 0)->find('.nobr', 0);
			if (!empty($yearTmp)){
				$movie["year"] = trim($yearTmp->find("a", 0)->plaintext);
			}

			//référence IMDb
			$imdbRef = trim($html->find("meta[property=pageId]",0)->getAttribute('content'));

			//évaluation
			$ratingTmp = $html->find("div[class=titlePageSprite star-box-giga-star]",0);
			if (!empty($ratingTmp)){
				$movie["rating"] = trim($ratingTmp->plaintext);
			}

			//url de la cover sans le suffixe ni l'extension
			$coverTmp = $html->find("#title-overview-widget",0)->find("img",0);
			if (!empty($coverTmp)){
				$movie["cover"] = trim(preg_replace("/@.*/", "", $coverTmp->src));
			}

			//réalisateurs
			$directorsTmp = $html->find("div[itemprop=director]",0);
			if(!empty($directorsTmp)){
				$movie["directors"] = $directorsTmp->find("span[itemprop=name]");
			}

			//scénaristes
			$writersTmp = $html->find("div[itemprop=creator]",0);
			if(!empty($writersTmp)){
				$movie["writers"] = $writersTmp->find("span[itemprop=name]");
			}

			//acteurs
			$starsTmp = $html->find("div[itemprop=actors]",0);
			if (!empty($starsTmp)){
				$movie["stars"] = $starsTmp->find("span[itemprop=name]");
			}

			//genres
			$genresTmp = $html->find("span[itemprop=genre]");
			if (!empty($genresTmp)){
				$movie["genres"] = $genresTmp;		
			}
		}
		
		//sinon (erreur)
		else{
			//affichage de l'erreur d'import (pas encore créé)
			// $this->show("movie/addMovie", [$error => "L'URL n'est pas correcte");
		}


	}
		//fonction avec parametres a utiliser apres test complets en remplacement des tableaux ci dessous
		/*public function MovieInsert($movie, $genres, $humans)*/
		public function MovieInsert($movie, $genres)
		{
			$movie= [
			"title" => "film de test",
			"synopsis" => "lorem hipsum",
			"duration" => "93",
			"year" => "1978",
			"imdbRef" => "456", 
			"imdbRating" => "5",
			"cover" => "http://ia.media-imdb.com/images/M/MV5BMTUyNzgxNjg2M15BMl5BanBnXkFtZTgwMTY1NDI1NjE@._V1_UY209_CR0,0,140,209_AL_.jpg"];

			$genres = ["Crime", "Drama"];

			$humans = [
				[
					"name" => "Alessandro Carloni",
					"role" => "directors",
					"imdbRef" => "nm1868917"
				],
				[
					"name" => "Jennifer Yuh",
					"role" => "writers",
					"imdbRef" => "nm0950775"
				],
				[
					"name" => "Dustin Hoffman",
					"role" => "stars",
					"imdbRef" => "nm0000163"
				];

			//Create 3 Instanciation of the differents manager for each table
			$movieManager= new \Manager\MovieManager;
			//Insert datas received in each respective table
			$movieManager->insert($movie);
			//insere l'id du dernier film cree dans la variable $movieId
			$movieId=$movieManager->lastId();

			$genreManager= new \Manager\GenreManager();
			//conversion du tableau de genre string en id
			$genreIds = $genreManager->strToId($genres);
			//creation d'une instance de la table Movies__genres
			$MoviesGenresManager = new \Manager\MoviesGenresManager();
			//insertion des lignes
			$MoviesGenresManager->InsertLine($movieId, $genreIds);

		}
}

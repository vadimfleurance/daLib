<?php
namespace Controller;

use \W\Controller\Controller;
use Sunra\PhpSimple\HtmlDomParser;

class ScraperController extends Controller
{

	public function addHeaderToUrl($url)
	{
		// Switch the page in English
		$options = ['http' => [
		    'method'=>"GET",
		    'header'=>"Accept-language: en\r\n"
		]];
		$context = stream_context_create($options);

		// Open the file using the HTTP headers set above
		return file_get_contents($url, false, $context);
	}

	public function verifyUrl($link)
	{
		// si l'url ou l'id passé a une syntaxe valide
		if (preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/$!", $link) || preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/\?.*!", $link) || preg_match("!^[t]{2}\d{7}$!", $link)){

			//vérifie si le texte passé est un id d'IMDb  (sans les slash autour) de type "ttxxxxxxx" ou les x sont des chiffres de 0 à 9 et le traite si c'est le cas
			if (preg_match("!^[t]{2}\d{7}$!", $link)){
				return "http://www.imdb.com/title/" . $link . "/";
			}

			//vérifie si le texte passé est une URL d'un film sur IMDb
			if (preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/$!", $link)){
				return $link;
			}

			//vérifie si le texte passé est une URL avec des paramètres et supprime les paramètres si c'est le cas
			if(preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/\?.*!", $link)){
				return preg_replace("/\?.*/", "", $link);
			}
		}
		else{
			//si l'url n'est pas correcte, retourne false (erreur)
			return false;
		}
	}

	public function globalScraper()
	{
		
		// Target
		$url = "http://www.imdb.com/chart/moviemeter?ref_=nv_mv_mpm_7";

		$content = $this->addHeaderToUrl($url);
		// Create a new  domparser object stocked into "$html"
		$html = HtmlDomParser::str_get_html($content);


		
		

		$count=0;
		// Find every link to single movie page inside the movies top page 
		foreach ( $html->find(".titleColumn a") as $href ) {
			/*if ($count == 50){break;}*/
			$regIdMovie = '!tt\d{7}!';
			$urlMovie = $href->href;

			preg_match( $regIdMovie , $urlMovie , $matches );

			$link = "http://www.imdb.com/title/" . $matches[0] . "/";
			$this->pageScraper($link);
			/*$count++;*/
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
		//modifie le time out pour ne pas avoir de problème pendant le scrapping
		ini_set("max_execution_time", 30);
		//extraire toutes les donnees necessaires d'une page d'un film
		//initialisation du tableau qui contiendra la plupart des données du film
		$movie = [
			"title" => "",
			"synopsis" => "",
			"duration" => "",
			"year" => "",
			"imdbRef" => "",
			"imdbRating" => "",
			"cover" => "",
			"dateCreated" => date("Y-m-d H:i:s"),
			"dateModified" => date("Y-m-d H:i:s")
			];
		$genres = [];
		$humans = [];
		//utilisation de la fonction trim pour supprimer les espaces en début et en fin de chaine
		$link = trim($link);

		$content = $this->addHeaderToUrl($link);
		//crée un objet de la classe simple_html_dom et lui passe le contenu html de la page imdb
		$html = HtmlDomParser::str_get_html($content);

		//récupération des différents champs
		//utilisation de la fonction trim pour supprimer les espaces en début et en fin de chaine

		//titre du film
		$movie["title"] = preg_replace("!&.+!", "", $html->find('h1[itemprop=name]', 0)->plaintext);

		//synopsis
		$synopsisTmp = $html->find("div[itemprop=description]",1);
		if (!empty($synopsisTmp)){
			$writtenBy = $synopsisTmp->find('em',0);

			$movie["synopsis"] = trim(str_replace($writtenBy ? $writtenBy->plaintext : "", "", $synopsisTmp->plaintext));
		}

		//duration
		$durationTmp = $html->find("time[itemprop=duration]",0);
		if (!empty($durationTmp)){
			$movie["duration"] = preg_replace("![^\d]!", "", $durationTmp->datetime);
		}

		//year
		preg_match_all("!\d{4}!", $html->find("title", 0)->plaintext, $matches);
		if (!empty(end($matches))){
			$movie["year"] = end($matches[0]);
		}

		//imdbRef
		$movie['imdbRef'] = trim($html->find("meta[property=pageId]",0)->getAttribute('content'));

		//imdbRating
		$ratingTmp = $html->find("span[itemprop=ratingValue]",0);
		if (!empty($ratingTmp)){
			$movie["imdbRating"] = trim($ratingTmp->plaintext);
		}

		//url cover without suffix and extension
		$coverTmp = $html->find("#title-overview-widget",0)->find("img",0);
		if (!empty($coverTmp)){
			$movie["cover"] = trim(preg_replace("/@.*/", "", $coverTmp->src));
		}

		$humansTmp = $html->find(".credit_summary_item");

		//réalisateurs, scénaristes et acteurs
		if ($humansTmp){
			foreach($humansTmp as $human){
				$directors = $human->find("span[itemprop=director]");
				$writers = $human->find("span[itemprop=creator]");
				$stars = $human->find("span[itemprop=actors]");

				//réalisateurs
				if($directors){
					foreach ($directors as $director) {
						preg_match("!nm\d{7}!", $director->find("a", 0)->href, $matches);

						$humans[] = [
							"name" => trim($director->find("span[itemprop=name]", 0)->plaintext),
							"role" => "director",
							"imdbRef" => $matches[0]
						];
					}
				}
				//scénaristes
				if($writers){
					foreach ($writers as $writer) {
						preg_match("!nm\d{7}!", $writer->find("a", 0)->href, $matches);

						$humans[] = [
							"name" => trim($writer->find("span[itemprop=name]", 0)->plaintext),
							"role" => "writer",
							"imdbRef" => $matches[0]
						];
					}
				}
				//acteurs
				if($stars){
					foreach ($stars as $star) {
						preg_match("!nm\d{7}!", $star->find("a", 0)->href, $matches);

						$humans[] = [
							"name" => trim($star->find("span[itemprop=name]", 0)->plaintext),
							"role" => "star",
							"imdbRef" => $matches[0]
						];
					}
				}
			}
		}

		//genres
		$genresTmp = $html->find("span[itemprop=genre]");
		if (!empty($genresTmp)){
			foreach ($genresTmp as $genre){
				$genres[] = $genre->plaintext;
			}
			
		}
		$this->MovieInsert($movie,$genres,$humans);
	}


	public function MovieInsert($movie, $genres, $humans)
	{
		/*debug($movie);
		die();*/

		//Create 1 object of the movie manager
		$movieManager = new \Manager\MovieManager;
		//Insert datas received from previous $movie array into movie table in database
		if($movieManager->isnew($movie)){
			$movieManager->insert($movie);

			//get last movie id and stock it in $movieId
			$movieId=$movieManager->lastId();

			//Create 1 object of the genre manager
			$genreManager = new \Manager\GenreManager();
			//convert $genres array of strings received from pagescrapper method into new id's array stored in $genreIds
			$genreIds = $genreManager->strToId($genres);

			//Create 1 object of MoviesGenreManager
			$MoviesGenresManager = new \Manager\MoviesGenresManager();
			//insert as many lines into table movie__genre as movie as genres
			$MoviesGenresManager->InsertLine($movieId, $genreIds);

			//Create 1 object of HumanManager and 1 object of MoviesHumanManager
			$HumanManager = new \Manager\HumanManager();
			$MoviesHumanManager = new \Manager\MoviesHumanManager();

			//parcours le tableau humans pour en extraire chaque sous tableau dont il insere les données dans les tables human 
			//et movies accompagné du dernier id de human parcouru et du dernier id movie parcouru
			foreach ($humans as $human) {
				if($HumanManager->isNew($human)){
					$HumanManager->insert(
									[
										'name'=>$human['name'],
										'imdbRef'=>$human['imdbRef']
									]);

					$lastHumanId = $HumanManager->lastId();
				}
				else {

					$lastHumanId = $HumanManager->getId($human);
				}


				$MoviesHumanManager->insert(
									[
										'idMovie'=>$movieId,
										'idHuman'=>$lastHumanId,
										'role'=>$human['role']
									]);
			}//end of foreach
		}//end of if	

	}//end of method
}//end of class

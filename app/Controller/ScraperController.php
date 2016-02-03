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
		//vérifie si le texte passé est un id d'IMDb  (sans les slash autour) de type "ttxxxxxxx" ou les x sont des chiffres de 0 à 9 et le traite si c'est le cas
		if (preg_match("!^[t]{2}\d{7}$!", $link)){
			return "http://www.imdb.com/title/" . $link . "/";
		}

		//sinon vérifie si le texte passé est une URL d'un film sur IMDb
		else if (preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/$!", $link)){
			return $link;
		}

		//sinon vérifie si le texte passé est une URL avec des paramètres et supprime les paramètres si c'est le cas
		else if(preg_match("!^http://www.imdb.com/title/[t]{2}\d{7}/\?.*!", $link)){
			return preg_replace("/\?.*/", "", $link);
		}
		
		//sinon l'url n'est pas correcte, retourne false (erreur)
		else{
			return false;
		}
	}

	//vérifie si l'url ne renvoie pas vers une erreur 404
	public function verifyHeader($link)
	{
		$headerStatus = get_headers($link);
		if($headerStatus[0] == "HTTP/1.1 200 OK"){
			return true;
		}

		else{
			return false;
		}
	}

	public function globalScraper()
	{		
		// Target
		$url = "http://www.imdb.com/chart/top";

		$content = $this->addHeaderToUrl($url);
		// Create a new  domparser object stocked into "$html"
		$html = HtmlDomParser::str_get_html($content);

		// Find every link to single movie page inside the movies top page 
		foreach($html->find(".titleColumn a") as $href){
			//modifie le time out pour ne pas avoir de problème pendant le scrapping
			ini_set("max_execution_time", 30);

			$regIdMovie = '!tt\d{7}!';
			$urlMovie = $href->href;

			preg_match($regIdMovie, $urlMovie, $matches);

			$link = "http://www.imdb.com/title/" . $matches[0] . "/";
			preg_match("!tt\d{7}!", $link, $matches);
			$movie["imdbRef"] = $matches[0];
			$movieManager = new \Manager\MovieManager;
			$isNew = $movieManager->isNew($movie);

			if ($isNew){
				$this->pageScraper($link);
			}
		}
	}

	public function pageScraper($link)
	{
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
		$synopsisTmp = $html->find("#titleStoryLine div[itemprop=description] p", 0);
		if ($synopsisTmp){
			$writtenBy = $synopsisTmp->find('em',0);

			$movie["synopsis"] = trim(str_replace($writtenBy ? $writtenBy->plaintext : "", "", $synopsisTmp->plaintext));
		}

		//durée
		$durationTmp = $html->find("time[itemprop=duration]",1);
		if ($durationTmp){
			$movie["duration"] = str_replace(" min", "", $durationTmp->plaintext);
		}

		//année
		preg_match_all("!\d{4}!", $html->find("title", 0)->plaintext, $matches);
		if ($matches){
			$movie["year"] = end($matches[0]);
		}

		//imdbRef
		$movie['imdbRef'] = trim($html->find("meta[property=pageId]",0)->getAttribute('content'));

		//imdbRating
		$ratingTmp = $html->find("span[itemprop=ratingValue]",0);
		if ($ratingTmp){
			$movie["imdbRating"] = trim($ratingTmp->plaintext);
		}

		//url cover sans le suffixe ni l'extension
		$coverTmp = $html->find(".poster img",0);
		if ($coverTmp){
			$movie["cover"] = trim(preg_replace("!\._.+!", "", $coverTmp->src));
		}

		//réalisateurs
		$directors = $html->find("div.credit_summary_item span[itemprop=director] span[itemprop=name]");

		if($directors){
			foreach($directors as $director){
				preg_match("!nm\d{7}!", $director->parent()->href, $matches);
				$humans[] = [
					"name" => trim($director->plaintext),
					"role" => "director",
					"imdbRef" => $matches[0]
				];
			}
		}

		//scénaristes
		$writers = $html->find("div.credit_summary_item span[itemprop=creator] span[itemprop=name]");

		if($writers){
			foreach($writers as $writer){
				preg_match("!nm\d{7}!", $writer->parent()->href, $matches);
				$humans[] = [
					"name" => trim($writer->plaintext),
					"role" => "writer",
					"imdbRef" => $matches[0]
				];
			}
		}

		//acteurs
		$stars = $html->find("div.credit_summary_item span[itemprop=actors] span[itemprop=name]");

		if($stars){
			foreach($stars as $star){
				preg_match("!nm\d{7}!", $star->parent()->href, $matches);
				$humans[] = [
					"name" => trim($star->plaintext),
					"role" => "star",
					"imdbRef" => $matches[0]
				];
			}
		}

		//genres
		$genresTmp = $html->find("span[itemprop=genre]");
		if ($genresTmp){
			foreach ($genresTmp as $genre){
				$genres[] = $genre->plaintext;
			}
			
		}
		$this->MovieInsert($movie,$genres,$humans);
	}


	public function MovieInsert($movie, $genres, $humans)
	{
		//Create 1 object of the movie manager
		$movieManager = new \Manager\MovieManager;
		//Insert datas received from previous $movie array into movie table in database
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
		}
	}
}

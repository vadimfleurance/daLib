<?php
namespace Controller;


use \W\Controller\Controller;

class MovieController extends Controller
{
	public function movieDetails($id)
	{	
		/*$user = $this->getUser();
		
		$movieManager = new \Manager\MovieManager;
		$movie = $movieManager->getInfos($id);

		$moviesUserManager = new \Manager\MoviesUsersManager;
		$statusValues = $moviesUserManager->getStatus($id, $user['id'] );
		$this->show('movie/details', ['movie' => $movie, 'statusValues' => $statusValues ]);*/

		$user = $this->getUser();

		$movieManager = new \Manager\MovieManager;
		$movie = $movieManager->getInfos($id);

		// Si movie est faux (donc que le film n'est pas présent en base de données), redirige vers une erreur 404
		if(!$movie){
			$this->showNotFound();
		}
		// Calcul du nombre de genres, de producteurs, de scénaristes et d'acteurs
		$genresNb = count($movie['genres']);
		$directorsNb = count($movie['directors']);
		$writersNb = count($movie['writers']);
		$starsNb = count($movie['stars']);

		// Si une durée est présente
		if ($movie['duration']){

			// Si le film dure au moins 60 minutes, calcul de la durée en format heure minute avec durée en minute entre parenthèses
			if (floor($movie['duration']/60) != 0){
				$movie['duration'] = floor($movie['duration']/60) . 'h ' . $movie['duration']%60 . 'min (' . $movie['duration'] . ' min)';
			}

			// Sinon laisse la durée en minutes
			else{
				$movie['duration'] = $movie['duration'] . ' min';
			}			
		}

		$moviesUserManager = new \Manager\MoviesUsersManager;
		$movieCollectionFound = $moviesUserManager->isPresent($id, $user['id']);
		$this->show('movie/details', [
										'movie' => $movie,
										'movieCollectionFound' => $movieCollectionFound,
										'genresNb' => $genresNb,
										'directorsNb' => $directorsNb,
										'writersNb' => $writersNb,
										'starsNb' => $starsNb,
									]);
	}

	public function addMovie()
	{
		//s'affiche dans le template si le film a été ajouté
		$errorScrap = "";
		//s'affiche dans le template si le film est déjà présent en base de données ou si l'url n'est pas correcte
		$successScrap = "";

		//si le formulaire est soumis
		if ($_POST){

			//vérification que l'url est correcte
			$scraperController = new \Controller\ScraperController;
			$url = $scraperController->verifyUrl($_POST['add-movie-input']);

			//si l'url est correcte
			if ($url){
				$headerStatus = $scraperController->verifyHeader($url);

				//si l'url ne renvoie pas vers une erreur 404 d'IMDb
				if($headerStatus){
					//récupère la référence IMDb du lien que l'utilisateur a donné puis vérifie s'il est présent dans la base de données
					preg_match("!tt\d{7}!", $url, $matches);
					$movie["imdbRef"] = $matches[0];
					$movieManager = new \Manager\MovieManager;
					$isNew = $movieManager->isNew($movie);
					//si le film n'est pas présent dans la base de données
					if($isNew){
						$scraperController->pageScraper($url);
						$successScrap = "The movie has been added.";
					}

					//si le film est déjà présent dans la base de données
					else{
						$errorScrap = "The movie is already present in our database.";
					}					
				}
				//si l'url renvoie vers une erreur 404
				else{
					$errorScrap = "IMDb reference is invalid";
				}
			}

			//si l'url n'est pas correcte
			else{
				$errorScrap = "URL is invalid.";
			}

		}
		$this->show('movie/add_movie', ["successScrap" => $successScrap, "errorScrap" => $errorScrap]);
	}

	public function searchAjax()
	{
		$movieManager = new \Manager\MovieManager();
		$moviesFound = $movieManager->searchAjax();
		$this->show('movie/search_ajax', ["moviesFound" => $moviesFound]);
	}
	
	public function search($page = 1)
	{
		$movieManager = new \Manager\MovieManager();
		$moviesNb = $movieManager->getCount();
		$moviesFound = $movieManager->search($page);

		// calcul du nombre de page à afficher
		$nbPage = ceil($moviesNb/10);
		if($page > $nbPage){
			$this->showNotFound();
		}
		$this->show('movie/search', ["moviesFound" => $moviesFound, "nbPage" => $nbPage, "page" => $page]);
	}
}
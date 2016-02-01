<?php
namespace Controller;


use \W\Controller\Controller;

class MovieController extends Controller
{
	public function movieDetails($id)
	{	
		$user = $this->getUser();
		
		$movieManager = new \Manager\MovieManager;
		$movie = $movieManager->getInfos($id);

		$moviesUserManager = new \Manager\MoviesUsersManager;
		$statusValues = $moviesUserManager->getStatus($id, $user['id'] );
		$this->show('movie/details', ['movie' => $movie, 'statusValues' => $statusValues ]);
	}

	public function addMovie()
	{
		//variable qui s'affiche dans le template et qui dit si le film a été ajouté, s'il est déjà présent en base de données ou si l'url n'est pas correcte
		$stateScrap = "";

		//si le formulaire est soumis
		if ($_POST){
			$url = $_POST["add-movie-input"];
			//vérification que l'url est correcte
			$scraperController = new \Controller\ScraperController;
			$results = $scraperController->verifyUrl($url);

			//si l'url est correcte
			if ($results){

				//récupère la référence IMDb du lien que l'utilisateur a donné puis vérifie s'il est présent dans la base de données
				preg_match("!tt\d{7}!", $results, $matches);
				$movie["imdbRef"] = $matches[0];
				$movieManager = new \Manager\MovieManager;
				$isNew = $movieManager->isNew($movie);
				//si le film n'est pas présent dans la base de données
				if($isNew){
					$scraperController->pageScraper($results);
					$stateScrap = "The movie has been added.";					
				}

				//si le film est déjà présent dans la base de données
				else{
					$stateScrap = "The movie is already present in our database.";
				}
			}

			//si l'url n'est pas correcte
			else{
				$stateScrap = "URL is not valid.";
			}

		}
		$this->show('movie/add_movie', ["stateScrap" => $stateScrap]);
	}

	public function searchAjax()
	{
		$movieManager = new \Manager\MovieManager();
		$moviesFound = $movieManager->searchAjax();
		$this->show('movie/search_ajax', ["moviesFound" => $moviesFound]);
	}
	
	public function search($page, $search)
	{
		$movieManager = new \Manager\MovieManager();
		$moviesNb = $movieManager->getCount($search);
		$moviesFound = $movieManager->search($page, $search);

		// calcul du nombre de page à afficher
		$nbPage = ceil($moviesNb/10);
		if($page > $nbPage){
			$this->showNotFound();
		}
		$this->show('movie/search', ["moviesFound" => $moviesFound, "nbPage" => $nbPage, "page" => $page, 'search' => $search]);
	}
}
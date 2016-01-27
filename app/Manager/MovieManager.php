<?php
namespace Manager;

class MovieManager extends \W\Manager\Manager
{
	public function searchAjax()
	{
		$sqlMovie = "SELECT title, year, cover FROM movies WHERE title LIKE :title;";
		$statementMovie = $this->dbh->prepare($sqlMovie);
		$statementMovie->execute([':title' => "%" . $_GET['search-input']]);
		$moviesFound = $statementMovie->fetchAll();

		$sqlStars =	"SELECT movies__humans.idMovie, humans.name FROM movies, movies__humans, humans WHERE movies.id = movies__humans.idMovie AND movies__humans.idHuman = humans.id AND title LIKE :title AND movies__humans.role = 'star';";

		$statementStars = $this->dbh->prepare($sqlStars);
		$statementStars->execute([':title' => "%" . $_GET['search-input']]);
		$moviesStars = $statementStars->fetchAll();
		return ;
	}
	//permet d'appeller le manager et d'inserer dans la table movies
	public function lastId()
	{
		return $this->dbh->lastInsertId();
	}

	public function isNew($movie)
	{
		$stmt = $this->dbh->prepare('SELECT imdbRef FROM movies WHERE imdbRef= :imdbRef');
		$stmt->bindValue(':imdbRef', $movie['imdbRef']);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return ($result)? false : true ;
	}
}
<?php
namespace Manager;

class MovieManager extends \W\Manager\Manager
{
	public function searchAjax()
	{
		$sql = "SELECT movies.title, movies.year, (
		   SELECT GROUP_CONCAT(humans.name SEPARATOR ', ') FROM humans 
		   JOIN movies__humans ON humans.id = movies__humans.idHuman 
		   WHERE movies__humans.idMovie = movies.id AND movies__humans.role = 'star'
			) as humans
			FROM movies
			WHERE movies.title LIKE :title LIMIT 6;";

		$statement = $this->dbh->prepare($sql);
		$statement->execute([":title" => "%" . $_GET["search-input"] . "%"]);
		$moviesFound = $statement->fetchAll();

		return $moviesFound;
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
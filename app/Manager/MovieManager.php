<?php
namespace Manager;

class MovieManager extends \W\Manager\Manager
{
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

	public function getInfos($id)
	{
		

		$sql = 'SELECT 
				movies.title,
				movies.synopsis,
				movies.duration,
				movies.year,
				movies.imdbRating,
				movies.cover,
				genres.name,
				movies__humans.role,
				humans.name
				FROM movies
				LEFT JOIN movies__genres
				ON movies.id = movies__genres.idMovie
				LEFT JOIN genres
				ON genres.id = movies__genres.idGenre
				LEFT JOIN movies__humans
				ON movies.id = movies__humans.idMovie
				LEFT JOIN humans
				ON movies__humans.idHuman = humans.id
				WHERE movies.id =:id';

		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$rawinfos= $stmt->fetchAll();
		debug($rawinfos);
		
	}//end of getInfos method

}//end of class
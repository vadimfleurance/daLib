<?php
namespace Manager;

class MoviesGenresManager extends \W\Manager\Manager
{
	//permet d'appeller le manager et d'inserer dans la table Movies__Genres
	public function __construct()
	{
		//use parent constructor method
		parent::__construct();
		//redifine table name for use
		$this->setTable('movies__genres');
	}

	public function InsertLine($movieId, $genreIds)
	{	
		foreach ($genreIds as $genre) {
			$stmt= $this->dbh->prepare('INSERT INTO movies__genres (idMovie, idGenre) VALUES (:idMovie, :idGenre);');
			$stmt->bindValue(':idMovie', $movieId );
			$stmt->bindValue(':idGenre', $genre );
			$stmt->execute();
			
		}
	}
}
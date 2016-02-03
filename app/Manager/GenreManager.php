<?php
namespace Manager;

class GenreManager extends \W\Manager\Manager
{
	//permet de gere les interactions avec la table genres
	public function strToId($genres)
	{
		$genreIds=[];

		foreach ($genres as $genre) {
			$stmt= $this->dbh->prepare('SELECT id FROM genres WHERE name = :name');
			$stmt->bindValue(':name', $genre );
			$stmt->execute();
			$id= $stmt->fetchColumn();
			$genreIds[]=$id;
		}
		return $genreIds;
	}
}
<?php
namespace Manager;
class MoviesUsersManager extends \W\Manager\Manager
{
	//permet d'appeller le manager et d'inserer dans la table Movies__Humans
	public function __construct()
	{
		//use parent constructor method
		parent::__construct();
		//redefine table name for use
		$this->setTable('movies__users');
	}

	// Vérifie en DB si le film est dans la collection de l'utilisateur
	// Si oui, retourne True
	// Si non, retourne False
	public function isPresent($idMovie, $idUser)
	{
		$stmt = $this->dbh->prepare(
				'SELECT id FROM movies__users
				 WHERE idUser = :idUser
				 AND idMovie = :idMovie'
				 );
		$stmt->bindValue(':idUser', $idUser);
		$stmt->bindValue(':idMovie', $idMovie);
		$stmt->execute();
		$id = $stmt->fetchColumn();
		
		if(!$id){
			return false;
		}//end of if
		return true;
	}//end of method

	// Ajoute à la DB
	public function addToCollection($idMovie, $idUser)
	{
		$stmt = $this->dbh->prepare(
					'INSERT INTO movies__users (idMovie, idUser, dateCreated, dateModified)
					 VALUES (:idMovie, :idUser, NOW(), NOW())'
				 );
		$stmt->bindValue(':idMovie', $idMovie );
		$stmt->bindValue(':idUser', $idUser );
		return $stmt->execute(); // retourner un booleen exploitable pour une utilisation d'affichage d'etat de bouton
	}

	// Delete de la DB
	public function removeFromCollection($idMovie, $idUser)
	{
		$stmt = $this->dbh->prepare(
					'DELETE FROM movies__users 
					WHERE idMovie = :idMovie 
					AND idUser = :idUser'
				);
		$stmt->bindValue('idMovie', $idMovie);
		$stmt->bindValue('idUser', $idUser);
		return $stmt->execute(); // retourner un booleen exploitable pour une utilisation d'affichage d'etat de bouton
	}

	public function setStatus($status, $bool, $idMovie, $idUser)
	{	
		if(is_string($status) && is_int($bool) && is_int($idMovie) && is_int($idUser)) {
				$stmt = $this->dbh->prepare(
						"UPDATE movies__users
						SET $status = :bool, dateModified = NOW()	
						WHERE idMovie = :idMovie
						AND idUser = :idUser"
						);
				$stmt->bindValue(':bool', $bool);
				$stmt->bindValue(':idMovie', $idMovie);
				$stmt->bindValue(':idUser', $idUser);
				return $stmt->execute();
		}//end of if
		echo "error in method arguments ";
	}//end of method

	public function getStatus($idMovie, $idUser)
	{
		$stmt = $this->dbh->prepare(
			'SELECT watched, toWatch, owned, ofInterest, wanted
			FROM movies__users
			WHERE idUser = :idUser
			AND idMovie = :idMovie '
			);
		$stmt->bindValue(':idUser', $idUser);
		$stmt->bindValue(':idMovie', $idMovie);
		$stmt->execute();
		$statusValues = $stmt->fetch();
		return $statusValues;
	}
	
	public function getSingleStatus($idMovie, $idUser, $status)
	{
		$stmt = $this->dbh->prepare(
			"SELECT $status
			FROM movies__users
			WHERE idUser = :idUser
			AND idMovie = :idMovie"
			);
		$stmt->bindValue(':idUser', $idUser);
		$stmt->bindValue(':idMovie', $idMovie);
		$stmt->execute();
		return $value = $stmt->fetchColumn();
		
	}
	public function getEntireCollection($idUser,$cPage,$perPage)
	{		
		$stmt = $this->dbh->prepare(
				"SELECT *
				FROM movies__users
				WHERE idUser = :idUser
				ORDER BY dateModified DESC
				LIMIT ".(($cPage-1)*$perPage).", $perPage "
			);
		$stmt->bindValue(':idUser', $idUser);
		$stmt->execute();
		$rawcollection = $stmt->fetchAll();

		$collection=[
				'movies'=>[],
				'statuses'=>[]
		];

		foreach ($rawcollection as $relation ) {
			$movieManager = new \Manager\MovieManager;
			$collection['movies'][]= $movieManager->getInfos($relation['idMovie']);
			$collection['statuses'][] = $this->getStatus($relation['idMovie'],$relation['idUser']);
		}
		return $collection;
	}

	public function countCollection($idUser)
	{
		$stmt = $this->dbh->prepare(
			'SELECT COUNT(id) AS totalMovies
			FROM movies__users
			WHERE idUser = :idUser'
			);
		$stmt->bindValue(':idUser', $idUser);
		$stmt->execute();
		$totalMovies = $stmt->fetchColumn();
		return $totalMovies ;
	}
}//end of class
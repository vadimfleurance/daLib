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
	public function collect($idMovie, $idUser)
	{
		if(!$this->isPresent($idMovie, $idUser)){
			$stmt = $this->dbh->prepare(
							'INSERT INTO movies__users (idMovie, idUser, dateCreated, dateModified)
							 VALUES (:idMovie, :idUser, NOW(), NOW())'
							 );
			$stmt->bindValue(':idMovie', $idMovie );
			$stmt->bindValue(':idUser', $idUser );
			return $stmt->execute();//comment retourner un booleen exploitable pour une utilisation d'affichage d'etat de bouton
		}
		else echo "le film est deja present dans votre collection";

	}
	public function remove($idMovie, $idUser)
	{
		if($this->isPresent($idMovie, $idUser)){
			$stmt = $this->dbh->prepare(
					'DELETE FROM movies__users 
					WHERE idMovie = :idMovie 
					AND idUser = :idUser'
				);
			$stmt->bindValue('idMovie', $idMovie);
			$stmt->bindValue('idUser', $idUser);
			return $stmt->execute();
		}
		else echo  "ce film n'est pas present dans votre collection";
	}
	//LES METHODES CI DESSOUS SONT A VIRER SI PAS UTILISEE A LA FIN DU PROJET
	public function watched($bool, $idMovie, $idUser)
	{
		$this->setStatus('watched',$bool, $idMovie, $idUser);
	}

	public function toWatch($bool, $idMovie, $idUser)
	{
		$this->setStatus('toWatch',$bool, $idMovie, $idUser);
	}
	public function owned($bool, $idMovie, $idUser)
	{
		$this->setStatus('owned',$bool, $idMovie, $idUser);
	}
	public function ofInterest($bool, $idMovie, $idUser)
	{
		$this->setStatus('ofInterest',$bool, $idMovie, $idUser);
	}
	public function wanted($bool, $idMovie, $idUser)
	{
		$this->setStatus('wanted',$bool, $idMovie, $idUser);
	}
	//FIN DES METHODES A VIRER


	public function setStatus($status, $bool, $idMovie, $idUser)
	{	
		debug($status);
		debug($bool);
		debug($idMovie);
		debug($idUser);
		//if( is_string($status) && is_int($bool) && is_int($idMovie) && is_int($idUser)) {

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
		//}//end of if
		//echo "error in method arguments ";

	}//end of method

	public function isPresent($idMovie, $idUser)
	{	
		//selectionne tout les idmovie present dans une collection utilisateur.
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
		//debug($statusValues);
		return $statusValues;

	}
	public function getEntireCollection($idUser)
	{
		$stmt = $this->dbh->prepare(
				'SELECT *
				FROM movies__users
				WHERE idUser = :idUser'
			);
		$stmt->bindValue(':idUser', $idUser);
		$stmt->execute();
		$rawcollection = $stmt->fetchAll();
		//debug($rawcollection);
		//die();
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
		//debug($collection);
		//die();

	}

}//end of class
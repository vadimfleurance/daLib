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
			$stmt=$this->dbh->prepare(
							'INSERT INTO movies__users (idMovie, idUser, dateCreated, dateModified)
							 VALUES (:idMovie, :idUser, NOW(), NOW())'
							 );
			$stmt->bindValue(':idMovie', $idMovie );
			$stmt->bindValue(':idUser', $idUser );
			return $stmt->execute();//comment retourner un booleen exploitable pour une utilisation d'affichage d'etat de bouton
		}
		else echo "le film est deja present dans votre collection";

	}

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


	protected function setStatus($status, $bool, $idMovie, $idUser)
	{	if(is_string($status) && is_bool($bool) && is_int($idMovie) && is_int($idUser)) {

				$stmt = $this->dbh->prepare(
						"UPDATE movies__users
						SET $status = :bool, dateModified = NOW()	
						WHERE idMovie = :idMovie
						AND idUser = idUser"
						);
				$stmt->bindValue(':bool', $bool);
				$stmt->bindValue(':idMovie', $idMovie);
				$stmt->bindValue(':idUser', $idUser);
				return $stmt->execute();
		}//end of if
		echo "error in method arguments "

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

}//end of class
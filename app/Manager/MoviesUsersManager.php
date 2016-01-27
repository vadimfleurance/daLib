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

	public function isPresent()
	{	
		//selectionne tout les idmovie present dans une collection utilisateur.
		$sql = 'SELECT idMovie, FROM movies__users
				WHERE idUser = :id'
	}

}
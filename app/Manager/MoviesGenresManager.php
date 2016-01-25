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
}
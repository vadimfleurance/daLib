<?php
namespace Manager;

class MoviesHumanManager extends \W\Manager\Manager
{
	//permet d'appeller le manager et d'inserer dans la table Movies__Humans
	public function __construct()
	{
		//use parent constructor method
		parent::__construct();
		//redefine table name for use
		$this->setTable('movies__humans');
	}

}
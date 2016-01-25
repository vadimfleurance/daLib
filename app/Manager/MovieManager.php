<?php
namespace Manager;

class MovieManager extends \W\Manager\Manager
{
	//permet d'appeller le manager et d'inserer dans la table movies
	public function lastId()
	{
		return $this->dbh->lastInsertId();
	}
}
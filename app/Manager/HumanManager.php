<?php
namespace Manager;

	//permet de gerer les interactions avec la table human
class HumanManager extends \W\Manager\Manager
{
	//permet de recuperer le dernir id de human inseré en base
	public function lastId()
	{
		return $this->dbh->lastInsertId();
	}

	
}
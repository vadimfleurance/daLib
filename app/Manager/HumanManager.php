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

	public function isNew($human)
	{
		$stmt = $this->dbh->prepare('SELECT imdbRef FROM humans WHERE imdbRef= :imdbRef');
		$stmt->bindValue(':imdbRef', $human['imdbRef']);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return ($result)? false : true ;
	}

	public function getId($human)
	{
		$stmt = $this->dbh->prepare('SELECT id FROM humans WHERE imdbRef= :imdbRef');
		$stmt->bindValue(':imdbRef', $human['imdbRef']);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
}
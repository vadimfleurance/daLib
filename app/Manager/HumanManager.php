<?php
namespace Manager;

class HumanManager extends \W\Manager\Manager
{
	//permet de gere les interactions avec la table human

	//permet d'inserer les champs dans la table en ne prenant pas en compte la valeur role du tableau d'origine
	public function partialInsert($humans)
	{
		
		foreach ($humans as $key => $value) {
			$stmt= $this->dbh->prepare('INSERT INTO humans (name , imdbRef) VALUES (:name , :imdbRef);');
			$stmt->bindValue(':name',$humans[$key]['name'] );
			$stmt->bindValue(':imdbRef',$humans[$key]['imdbRef'] );
			$stmt->execute();

		}
	}
}
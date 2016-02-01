<?php
namespace Manager;

class MovieManager extends \W\Manager\Manager
{
	public function searchAjax()
	{
		$sql = "SELECT
				movies.id,
				movies.title,
				movies.year,
				movies.cover,
				(	SELECT GROUP_CONCAT(humans.name SEPARATOR ', ')
					FROM humans 
					JOIN movies__humans
					ON humans.id = movies__humans.idHuman 
					WHERE movies__humans.idMovie = movies.id
					AND movies__humans.role = 'star'
				) as humans
				FROM movies
				WHERE movies.title
				LIKE :title
				LIMIT 6;";

		$statement = $this->dbh->prepare($sql);
		$statement->execute([":title" => "%" . $_GET["search"] . "%"]);
		return $statement->fetchAll();
	}

	public function search($search, $page)
	{
		(int) $limit = 10;
		(int) $offset = $page * $limit - $limit;

		$sql = "SELECT
				movies.id,
				movies.title,
				movies.year,
				movies.cover,
				(	SELECT GROUP_CONCAT(humans.name SEPARATOR ', ')
					FROM humans 
					JOIN movies__humans
					ON humans.id = movies__humans.idHuman 
					WHERE movies__humans.idMovie = movies.id
					AND movies__humans.role = 'star'
				) as actors,
				(	SELECT GROUP_CONCAT(humans.name SEPARATOR ', ')
					FROM humans
					JOIN movies__humans
					ON humans.id = movies__humans.idHuman
					WHERE movies__humans.idMovie = movies.id
					AND movies__humans.role = 'director'
				) as directors
				FROM movies
				WHERE movies.title
				LIKE :search
				LIMIT :offset, :limit;";

		$statement = $this->dbh->prepare($sql);
		$statement->bindValue(':search', "%" . $search . "%");
		$statement->bindValue(':offset', (int) $offset, 1);
		$statement->bindValue(':limit', (int) $limit, 1);
		$statement->execute();
		return $statement->fetchAll();
	}

	public function getCount($search)
	{
		$sql = "SELECT COUNT(*) FROM movies WHERE title LIKE :title;";
		$statement = $this->dbh->prepare($sql);
		$statement->execute([":title" => "%" . $search . "%"]);
		return $statement->fetchColumn();
	}

	//permet d'appeller le manager et d'inserer dans la table movies
	public function lastId()
	{
		return $this->dbh->lastInsertId();
	}

	public function isNew($movie)
	{
		$stmt = $this->dbh->prepare('SELECT imdbRef FROM movies WHERE imdbRef= :imdbRef');
		$stmt->bindValue(':imdbRef', $movie['imdbRef']);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return ($result)? false : true ;
	}

	public function getInfos($id)
	{
		
		//pour le panache
		$sql = 'SELECT 
				movies.id,
				movies.title,
				movies.synopsis,
				movies.duration,
				movies.year,
				movies.imdbRating,
				movies.cover,
				genres.name AS genre,
				movies__humans.role,
				humans.name
				FROM movies
				LEFT JOIN movies__genres
				ON movies.id = movies__genres.idMovie
				LEFT JOIN genres
				ON genres.id = movies__genres.idGenre
				LEFT JOIN movies__humans
				ON movies.id = movies__humans.idMovie
				LEFT JOIN humans
				ON movies__humans.idHuman = humans.id
				WHERE movies.id =:id';

		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$rawinfos= $stmt->fetchAll();
		//debug($rawinfos);

		$movie=[
			'id' =>$rawinfos[0]['id'],
			'title' => $rawinfos[0]['title'],
			'synopsis' => $rawinfos[0]['synopsis'],
			'duration' => $rawinfos[0]['duration'],
			'year' => $rawinfos[0]['year'],
			'imdbRating' => $rawinfos[0]['imdbRating'],
			'cover' => $rawinfos[0]['cover'],
			'genres' =>[],
			'directors' =>[],
			'writers'=>[],
			'stars'=>[]
		];
		
		//debug($movie);
		foreach ($rawinfos as $info) {

			//ajoute le genre dans l'array movie final si le genre n'est pas deja present
			if(!in_array($info['genre'], $movie['genres'])){
				$movie['genres'][] = $info['genre'];
			}
			// si le role est director recupere le nom et ajoute le au rang director du tableau movie
			if($info['role'] === 'director'){
				if(!in_array($info['name'], $movie['directors'])){
					$movie['directors'][] = $info['name'];
				}
			}
			// si le role est writer recupere le nom et ajoute le au rang writers du tableau movie
			if($info['role'] === 'writer'){
				if(!in_array($info['name'], $movie['writers'])){
					$movie['writers'][] = $info['name'];
				}
			}
			// si le role est star recupere le nom et ajoute le au rang stars du tableau movie
			if($info['role'] === 'star'){
				if(!in_array($info['name'], $movie['stars'])){
					$movie['stars'][] = $info['name'];
				}
			}



		}//end of foreach
		//debug($movie);
		return $movie;
		
		
	}//end of getInfos method

}//end of class


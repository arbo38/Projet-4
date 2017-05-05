<?php

namespace App\Table;

use \Core\Table\Table;

class ArticleTable extends Table {

	public function get($id){
		$article = $this->query("
			SELECT articles.id as id, articles.titre as titre, articles.contenu as contenu, articles.date as date, articles.categorie_id as categorie_id, categories.categorie as categorie
			FROM articles
			LEFT JOIN categories ON articles.categorie_id = categories.id
			WHERE articles.id = :id
			", ['id' => $id], true, true);
		return $article;
	}

	public function getByCategorie($id){
		$articlesByCategorie  = $this->query("
			SELECT articles.id as id, articles.titre as titre, articles.contenu as contenu, articles.date as date, articles.categorie_id as categorie_id, categories.categorie as categorie
			FROM articles
			LEFT JOIN categories ON articles.categorie_id = categories.id
			WHERE articles.categorie_id = :id
			ORDER BY articles.date DESC
			LIMIT 3
			", ['id' => $id], true, false);
		return $articlesByCategorie;
	}

	public function getAll(){
		$articles  = $this->query("
			SELECT articles.id as id, articles.titre as titre, articles.contenu as contenu, articles.date as date, articles.categorie_id as categorie_id, categories.categorie as categorie
			FROM articles
			LEFT JOIN categories ON articles.categorie_id = categories.id
			ORDER BY articles.id DESC
			LIMIT 10
			", null, true, false);
		return $articles;
	}

	public function getLast(){
		$articles  = $this->query("
			SELECT articles.id as id, articles.titre as titre, articles.contenu as contenu, articles.date as date, articles.categorie_id as categorie_id, categories.categorie as categorie
			FROM articles
			LEFT JOIN categories ON articles.categorie_id = categories.id
			ORDER BY articles.id DESC
			LIMIT 1
			", null, true, true);
		return $articles;
	}

	public function new(array $datas){
		$columns = "";
		$attributes = [];
		$values = "";
		$date = date("Y-m-d H:i:s");
		foreach ($datas as $key => $value) {
			$columns .= "$key,";
			$values .= ":$key,";
			$attributes[$key] = $value;
		}
		$columns = substr($columns, 0, (strlen($columns)-1));
		$values = substr($values, 0, (strlen($values)-1));
		$statement = "INSERT INTO ".$this->table." ($columns, date)
		VALUES ($values, '$date')";
		var_dump($statement);
		var_dump($attributes);
		return $this->query($statement, $attributes);
	}

	public function update(int $id, array $datas){
		$set = "";
		$date = date("Y-m-d H:i:s");
		$attributes = [
			'id' => $id,
			'date' => $date
		];
		foreach ($datas as $key => $value) {
			$set .= "$key=:$key,";
			$attributes[$key] = $value;
		}
		$set = substr($set, 0, (strlen($set)-1));
		$statement = "UPDATE ".$this->table." SET ".$set.",date=:date WHERE id = :id
		";
		return $this->db->prepare($statement, $attributes);
	}


}
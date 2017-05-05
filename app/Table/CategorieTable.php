<?php

namespace App\Table;

use \Core\Table\Table;

class CategorieTable extends Table {

	public function get($id){
		$categorie = $this->query("
			SELECT categorie
			FROM categories
			WHERE id = :id
			", ['id' => $id], true, true);
		return $categorie;
	}

	public function getAll(){
		$categories  = $this->query("
			SELECT *
			FROM ".$this->table."
			", null, true);
		return $categories;
	}

	public function new(array $datas){
		$statement = "INSERT INTO ".$this->table." (categorie)
		VALUES (:categorie)";
		return $this->query($statement, $datas);
	}
	
}
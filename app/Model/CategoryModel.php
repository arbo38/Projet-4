<?php

namespace App\Model;

use \Core\Model\Model;

class CategoryModel extends Model {

	public function get($id){
		$category = $this->query("
			SELECT categorie
			FROM categories
			WHERE id = :id
			", ['id' => $id], true, true);
		return $category;
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
		VALUES (:category)";
		return $this->query($statement, $datas);
	}
	
}
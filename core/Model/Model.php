<?php

namespace Core\Model;

/**
     * Parent générique de tous les Model, permet l'héritage de fonctions spécifiques à l'accès à la BDD.
*/

class Model {

	protected $table;
	protected $db;

	public function __construct(\Core\Database\Database $db){
		$this->db = $db;
		if(is_null($this->table)){
			$tableName = explode('\\', get_class($this));
			$tableName = end($tableName);
			$tableName = strtolower($tableName);
			$tableName = str_replace('model', '', $tableName) . 's';
			if(substr($tableName, strlen($tableName) - 2) == 'ys'){
				$tableName = str_replace('ys', 'ies', $tableName);
			}
			$this->table = $tableName;
		}
	}

	public function extraction($key, $value){
		$records = $this->getAll();
		$return = [];
		foreach ($records as $record) {
			$return[$record->$key] = $record->$value;
		}
		return $return;
	}

	protected function query($statement, $attributes = null, $className = false, $one = false){
		if($attributes){
			if($className === false){
				return $this->db->prepare($statement, $attributes, null, $one);
			} else {
				return $this->db->prepare($statement, $attributes, str_replace('Model','Entity',get_class($this)), $one);
			}
		} else {
			if($className === false){
				return $this->db->query($statement);
			} else {
				return $this->db->query($statement, str_replace('Model','Entity',get_class($this)), $one);
			}
			
		}
	}

	public function get($itemId){
		$item = $this->query("
			SELECT *
			FROM ".$this->table."
			WHERE id = :id
			", ['id' => $itemId], true, true);
		return $item;
	}

	public function getAll(){
		$items  = $this->query("
			SELECT *
			FROM ".$this->table."
			", null, true);
		return $items;
	}

	public function add($data){
		$columns = "";
		$attributes = [];
		$values = "";
		foreach ($data as $key => $value) {
			$columns .= "$key,";
			$values .= ":$key,";
			$attributes[$key] = $value;
		}
		$columns = substr($columns, 0, (strlen($columns)-1));
		$values = substr($values, 0, (strlen($values)-1));
		$statement = "INSERT INTO ".$this->table." ($columns)
		VALUES ($values)";
		return $this->query($statement, $attributes);
	}

	public function update(int $id, array $datas){
		$set = "";
		$attributes = [
			'id' => $id
		];
		foreach ($datas as $key => $value) {
			$set .= "$key=:$key,";
			$attributes[$key] = $value;
		}
		$set = substr($set, 0, (strlen($set)-1));
		$statement = "UPDATE ".$this->table." SET ".$set." WHERE id = :id
		";
		return $this->db->prepare($statement, $attributes);
	}

	public function delete($id){
		$statement = "DELETE FROM ".$this->table." WHERE id=:id";
		return $this->query($statement, ['id' => $id]);
	}

}
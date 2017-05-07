<?php

namespace Core\Model;

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

	public function query($statement, $attributes = null, $className = false, $one = false){
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
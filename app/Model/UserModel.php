<?php

namespace App\Model;

use \Core\Model\Model;

class UserModel extends Model {
	public function get($id){
		$user = $this->query("
			SELECT *
			FROM users
			WHERE id = :id
			", ['id' => $id], true, true);
		return $user;
	}

	public function getAll(){
		$user  = $this->query("
			SELECT *
			FROM users
			ORDER BY id DESC
			LIMIT 10
			", null, true, false);
		return $user;
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

	public function delete($id){
		$statement = "DELETE FROM users WHERE id = :id";
		return $this->db->prepare($statement, $id);
	}

}
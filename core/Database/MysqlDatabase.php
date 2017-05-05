<?php

namespace Core\Database;

use \PDO;

class MysqlDatabase extends Database{

	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $pdo = null;


	public function __construct($db_name, $db_user, $db_pass, $db_host){
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}

	private function getPDO(){
		if($this->pdo === null){
			$pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.'', $this->db_user, $this->db_pass, [
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
				]);
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}

	public function query($statement, $class_name = null, $one = false){
		$req = $this->getPDO()->query($statement);
		if(strpos($statement, 'UPDATE') === 0 
			|| strpos($statement, 'DELETE') === 0
			|| strpos($statement, 'INSERT') === 0
		)
		{
			return $req;
		}
		if($class_name === null){
			$req->setFetchMode(PDO::FETCH_OBJ);
		} else {
			$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		}
		if($one){
			$data = $req->fetch();
		} else {
			$data = $req->fetchAll();
		}
		return $data;
	}

	public function prepare($statement, $attributes, $class_name = null, $one = false){
		$req = $this->getPDO()->prepare($statement);
		$resultat = $req->execute($attributes);
		$test = strpos($statement, 'UPDATE') === 0;
		if(strpos($statement, 'UPDATE') === 0 
			|| strpos($statement, 'DELETE') === 0
			|| strpos($statement, 'INSERT') === 0
			)
		{
			return $resultat;
		} 
		if($class_name === null){
			$req->setFetchMode(PDO::FETCH_OBJ);
		} else {
			$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		}

		if($one){
			$data = $req->fetch();
		} else {
			$data = $req->fetchAll();
		}
			return $data;
		}

public function update($statement, $attributes){
	$req = $this->getPDO()->prepare($statement);
	$req->execute($attributes);
}

public function lastInsertId(){
	return $this->getPDO()->lastInsertId();
}

}

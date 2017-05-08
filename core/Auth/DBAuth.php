<?php

namespace Core\Auth;

use Core\Database\Database;

/**
     * Gère l'authenfication des utilisateurs 
*/

class DBAuth{

	private $db;

	public function __construct(Database $db){
		$this->db = $db;
	}

	public function getUserId(){
		if($this->logged()){
			return $_SESSION['auth'];
		}
	}

	public function login(string $username, string $password){
		$user = $this->db->prepare("
			SELECT * FROM users WHERE username = ?
			", [$username], null, true);
		if($user){
			if($user->password === sha1($password)){
				$_SESSION['auth'] = $user->id;
				return true;
			}
			return false;
		} else {
			return false;
		}
	}

	public function logged(){
		return isset($_SESSION['auth']);
	}

	public function admin(){
		if(isset($_SESSION['auth'])){
			$user = $this->db->prepare("
			SELECT status FROM users WHERE id = ?
			", [$_SESSION['auth']], null, true);
			if($user->status == 'admin'){
				return true;
			}
			return false;
		}
	}
}
<?php

namespace App\Controller;

use \Core\Auth\DBAuth;

/*
	UsersController utilise 2 modèles.
	Le modèle DBAuth pour savoir si l'utiliser est : logged->bool / login->bool / getUserId->int
	Le modèle UserTable pour les autres opérations :  get, getAll, new, update, delete
 */

class UserController extends AppController {

	protected $userModel; // UserTable;

	public function __construct(){
		parent::__construct();
		$this->auth = new DBAuth($this->app->getInstance()->getDb());
		$this->loadModel('user');
	}

	public function login(){
		$form = new \Core\HTML\BootstrapForm($_POST);
		$message = '';
		if($this->auth->logged()){
			return $this->espace_membre();
		}
		if(!empty($_POST)){
			if($this->auth->login($_POST['username'], $_POST['password'])){
				return $this->espace_membre(true);
			} else {
				$message = ['type' => 'danger', 'message' => 'Login ou Password incorrect'];
				return $this->render('users.login', compact('form', 'message'));
			}
		}
		$this->render('users.login', compact('form', 'message'));
	}

	public function logout(){
		$form = new \Core\HTML\BootstrapForm($_POST);
		$message = '';
		if($this->auth->logged()){
			session_destroy();
			$message = true;
			$message = ['type' => 'warning', 'message' => 'Vous avez été déconnecté'];
		} 		
		$this->render('users.logout', compact('message'));
	}

	public function espace_membre($params = null){
		if($this->auth->logged()){
			$message = '';
			$user = $this->userModel->get($this->auth->getUserId());
			if($params){
				$message = ['type' => 'success', 'message' => 'Vous êtes connecté'];
			}
			return $this->render('users.espace_membre', compact('user', 'message'));
		}
		
	}
}
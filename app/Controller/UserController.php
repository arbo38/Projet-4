<?php

namespace App\Controller;

use \Core\Auth\DBAuth;

/**
     * Controller gérant le rendu des pages liées au utilisateurs
*/

class UserController extends AppController {

	protected $userModel;

	public function __construct(){
		// Stock une instance de la class d'authentification
		parent::__construct();
		$this->auth = new DBAuth($this->app->getInstance()->getDb());
		// Chargement des Model propre au controller
		$this->loadModel('user');
	}

	/**
     * Affiche la page de connection
     */

	public function login(){
		$form = new \Core\HTML\BootstrapForm($_POST);
		$message = '';
		if($this->auth->logged()){
			return $this->espaceMembre();
		}
		if(!empty($_POST)){
			if($this->auth->login($_POST['username'], $_POST['password'])){
				return $this->espaceMembre(true);
			} else {
				$message = ['type' => 'danger', 'message' => 'Login ou Password incorrect'];
				return $this->render('users.login', compact('form', 'message'));
			}
		}
		$this->render('users.login', compact('form', 'message'));
	}

	/**
     * Affiche la page de déconnection
     */

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

	/**
     * Affiche la page Espace Membre
     */

	public function espaceMembre($params = null){
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
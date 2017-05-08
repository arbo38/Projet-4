<?php

namespace App\Controller\Admin;

use \Core\Auth\DBAuth;

/**
     * Controller parent des controllers d'administration de l'application, permet via son constructeur de vérifié que l'utilisateur est bien administrateur avant de donner accès aux fonctionnalités d'administration.
*/

class AppController extends \App\Controller\AppController{

	public function __construct(){
		parent::__construct();
		$auth = new DBAuth($this->app->getDb());
		if(!$auth->logged()){ // Oblige l'utilisateur a être authentifié pour avoir access au controllers d'administration
			$this->forbidden();
		} else { // Si il est bien loggé on vérifié qu'il soit admin
			if(!$auth->admin()){
				$this->forbidden();
			} 
		}
	}
}
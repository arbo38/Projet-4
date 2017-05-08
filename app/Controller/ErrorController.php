<?php

namespace App\Controller;

/**
     * Controller gérant le rendu des pages liées aux erreurs
*/

class ErrorController extends AppController{

	public function __construct(){
		parent::__construct();
	}

	/**
     * Affiche la page en cas d'accès refusé
     */

	public function forbiddenAccess(){
		$this->render('error.forbidden');
	}
}
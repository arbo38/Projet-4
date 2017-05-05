<?php

namespace App\Controller;

class ErrorController extends AppController{

	public function __construct(){
		parent::__construct();
	}

	public function forbiddenAccess(){

		$this->render('error.forbidden');
	}
}
<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;

class AppController extends Controller{

	protected $template = 'default';
	protected $viewPath;
	protected $app;

	public function __construct(){
		$this->viewPath = ROOT . '/app/Views/';
		$this->app = App::getInstance();
	}

	protected function loadModel($tableName){
		$modelName = $tableName . 'Model';
		$model = $this->app->getTable($tableName);
		$this->$modelName = $model;
	}
}
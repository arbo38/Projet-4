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

	public function notFound(){
		header("HTTP/1.0 404 Not Found");
		$this->render('error.404');
	}

	public function forbidden(){
		header("HTTP/1.0 403 Forbidden");
		header('Location: ?page=forbidden');
		exit;
	}
}
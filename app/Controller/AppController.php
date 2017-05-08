<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;

/**
     * Controller parent des controllers de l'application, permet l'héritage de fonctions spécifiques à l'application comme la fonction loadModel.
*/

class AppController extends Controller{

	protected $template = 'default';
	protected $viewPath;
	protected $app;

	public function __construct(){
		$this->viewPath = ROOT . '/app/Views/'; // Le chemin des vues de l'application
		$this->app = App::getInstance(); // Instance du Singleton d'application
	}

	/**
     * Stock dans le controller le Model demandé
     * @param string $tableName : le nom de la table en bdd
     * @return \App\Model : Un objet de class Model permettant l'interaction avec la bdd
     */

	protected function loadModel($tableName){
		$modelName = $tableName . 'Model';
		$model = $this->app->getTable($tableName);
		$this->$modelName = $model;
	}

	/**
     * Fonction propre à l'application d'affichage en cas d'erreur 404
     */

	public function notFound(){
		header("HTTP/1.0 404 Not Found");
		$this->render('error.404');
	}

	/**
     * Fonction propre à l'application d'affichage en cas d'accès interdit
     */

	public function forbidden(){
		header("HTTP/1.0 403 Forbidden");
		header('Location: ?page=forbidden');
		exit;
	}
}
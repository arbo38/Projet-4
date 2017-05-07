<?php


use \Core\Config;

/* Class générique de l'applicatation. Singleton.
La Class App permet l'instanciation (sans avoir à ce soucier du namespace) des différentes tables/modèles de l'application et de la connection à la base de données.
*/

class App {
	
	private static $title = 'Jean Forteroche - Le Blog'; // TItre principal
	private $db_instance;
	private static $_instance;

	// Core Methods

	public static function getInstance(){ // Instanciation du Singleton App
		if(self::$_instance === null){
			self::$_instance = new App();
		}
		return self::$_instance;

	}

	public static function load(){ // Fonction d'initialisation de l'application faisant démarrer la session ainsi que les 2 autoloaders pour les namespace \app et \core
		session_start();
		require ROOT . '/app/Autoloader.php';
		App\Autoloader::register();
		require ROOT . '/core/Autoloader.php';
		Core\Autoloader::register();
	}

	public function getTable($tableName){ // Renvoi une instance du modèle (category, comment, user etc...)
		$className = '\\App\\Model\\'. ucfirst($tableName) . 'Model';
		return new $className($this->getDb());
	}

	public function getDb(){ // Renvoi une instance de la database
		$config = Config::getInstance(ROOT . '/config/config.php');
		if(is_null($this->db_instance)){
			$this->db_instance = new \Core\Database\MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
		}
		return $this->db_instance;
	}

	// Optionnelles

	public function getTitle(){ // Renvoi le titre de la page
		return self::$title;
	}

	public function setTitle($title){ // Défini le titre de la page
		self::$title = $title;
	}
}

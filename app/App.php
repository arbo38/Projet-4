<?php


use \Core\Config;

class App {
	
	private static $title = 'Mon Blog';
	private $db_instance;
	private static $_instance;

	// Core Methods

	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new App();
		}
		return self::$_instance;

	}

	public static function load(){
		session_start();
		require ROOT . '/app/Autoloader.php';
		App\Autoloader::register();
		require ROOT . '/core/Autoloader.php';
		Core\Autoloader::register();
	}

	public function getTable($tableName){
		$className = '\\App\\Table\\'. ucfirst($tableName) . 'Table';
		return new $className($this->getDb());
	}

	public function getDb(){
		$config = Config::getInstance(ROOT . '/config/config.php');
		if(is_null($this->db_instance)){
			$this->db_instance = new \Core\Database\MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
		}
		return $this->db_instance;
	}

	// Optionnelles

	public function getTitle(){
		return self::$title;
	}

	public function setTitle($title){
		self::$title = $title;
	}
}

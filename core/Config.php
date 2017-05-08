<?php

namespace Core;

/**
     * Class permettant la lecture de la configuration a partir d'un fichier passé en paramètre.
     * Elle est invoqué dans la class App lié à l'application.
*/

class Config {

	private $settings = [];

	private static $_instance = null;

	public function __construct($file){
		$this->settings = require $file;
	}

	public static function getInstance($file){
		if(self::$_instance === null){
			self::$_instance = new Config($file);
			return self::$_instance;
		} else {
			return self::$_instance;
		}
	}

	public function get($key){
		if(!isset($this->settings[$key])){
			return null;
		} else {
			return $this->settings[$key];
		}
	}
}
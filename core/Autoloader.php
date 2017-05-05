<?php

namespace Core;

class Autoloader {

	private static function autoload($class){
		if(strpos($class, __NAMESPACE__ . '\\') === 0){
			$class = str_replace(__NAMESPACE__ . '\\', '', $class);
			require __DIR__ . '\\' . $class . '.php';
		}
	}

	public static function register(){
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}
}
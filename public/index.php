<?php



define('ROOT', dirname(__DIR__));
require ROOT .'\app\App.php';

App::load(); // Launch Autoloaders and Session_Start

$app = App::getInstance();

if(isset($_GET['page'])){
	$page = $_GET['page'];
} else {
	$page = 'home';
}

$router = new \App\Router\Router($page);

?>
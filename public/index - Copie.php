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
if($page === 'home'){
	$ArticleController = new \App\Controller\ArticleController();
	$ArticleController->index();
} elseif($page === 'article') {
	$ArticleController = new \App\Controller\ArticleController();
	$ArticleController->show();
} elseif($page === 'categorie') {
	$ArticleController = new \App\Controller\ArticleController();
	$ArticleController->categories();
} elseif($page === 'login') {
	$UsersController = new \App\Controller\UserController();
	$UsersController->login();
} elseif($page === 'logout') {
	$UsersController = new \App\Controller\UserController();
	$UsersController->logout();
} elseif ($page === 'admin.article.index') {
	$AdminArticleController = new \App\Controller\Admin\ArticleController();
	$AdminArticleController->index();
} elseif ($page === 'article.edit') {
	$AdminArticleController = new \App\Controller\Admin\ArticleController();
	$AdminArticleController->editArticle();
} elseif ($page === 'article.create') {
	$AdminArticleController = new \App\Controller\Admin\ArticleController();
	$AdminArticleController->newArticle();
} elseif ($page === 'categorie.create') {
	$AdminCategorieController = new \App\Controller\Admin\CategorieController();
	$AdminCategorieController->newCategorie();
} elseif ($page === 'categorie.edit') {
	$AdminCategorieController = new \App\Controller\Admin\CategorieController();
	$AdminCategorieController->editCategorie();
} elseif ($page === 'comment.edit') {
	$AdminCommentController = new \App\Controller\Admin\CommentController();
	$AdminCommentController->editComment();
} elseif ($page === 'comment.delete') {
	$AdminCategorieController = new \App\Controller\Admin\CommentController();
	$AdminCategorieController->deleteComment();
} else {
	$ArticleController = new \App\Controller\ArticleController();
	$ArticleController->index();
}

?>
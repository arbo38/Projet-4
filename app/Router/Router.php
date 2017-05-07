<?php

namespace App\Router;

class Router{

	public function __construct($page){
		if($page === 'home'){
			$this->home();
		} elseif($page === 'article') {
			$this->article();
		} elseif($page === 'categories') {
			$this->categories();
		} elseif($page === 'login') {
			$this->login();
		} elseif($page === 'logout') {
			$this->logout();
		} elseif ($page === 'admin.article.index') {
			$this->admin();
		} elseif ($page === 'article.edit') {
			$this->adminEditArticle();
		} elseif ($page === 'article.create') {
			$this->adminNewArticle();
		} elseif ($page === 'category.create') {
			$this->adminNewCategory();
		} elseif ($page === 'category.edit') {
			$this->adminEditCategory();
		} elseif ($page === 'comment.edit') {
			$this->adminEditComment();
		} elseif ($page === 'comment.delete') {
			$this->adminDeleteComment();
		} elseif ($page === 'forbidden') {
			$this->forbidden();
		} else {
			$this->notFound();
		}
	}

	public function home(){
		$ArticleController = new \App\Controller\ArticleController();
		$ArticleController->index();
	}

	public function article(){
		$ArticleController = new \App\Controller\ArticleController();
		$ArticleController->show();
	}

	public function categories(){
		$ArticleController = new \App\Controller\ArticleController();
		$ArticleController->categories();
	}

	public function login(){
		$UsersController = new \App\Controller\UserController();
		$UsersController->login();
	}

	public function logout(){
		$UsersController = new \App\Controller\UserController();
		$UsersController->logout();
	}

	public function admin(){
		$AdminArticleController = new \App\Controller\Admin\ArticleController();
		$AdminArticleController->index();
	}

	public function adminEditArticle(){
		$AdminArticleController = new \App\Controller\Admin\ArticleController();
		$AdminArticleController->editArticle();
	}

	public function adminNewArticle(){
		$AdminArticleController = new \App\Controller\Admin\ArticleController();
		$AdminArticleController->newArticle();
	}

	public function adminEditCategory(){
		$AdminCategoryController = new \App\Controller\Admin\CategoryController();
		$AdminCategoryController->editCategory();
	}

	public function adminNewCategory(){
		$AdminCategoryController = new \App\Controller\Admin\CategoryController();
		$AdminCategoryController->newCategory();
	}

	public function adminEditComment(){
		$AdminCommentController = new \App\Controller\Admin\CommentController();
		$AdminCommentController->editComment();
	}

	public function adminDeleteComment(){
		$AdminCommentController = new \App\Controller\Admin\CommentController();
		$AdminCommentController->deleteComment();
	}

	public function forbidden(){
		$ErrorController = new \App\Controller\ErrorController();
		$ErrorController->forbiddenAccess();
	}

	public function notFound(){
		$ErrorController = new \App\Controller\ErrorController();
		$ErrorController->notFound();
	}


	

}

?>
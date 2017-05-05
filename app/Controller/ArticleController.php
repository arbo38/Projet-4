<?php

namespace App\Controller;

use \App\Controller\AppController;
use \App;

class ArticleController extends AppController{

	public function __construct(){
		parent::__construct();
		$this->loadModel('article');
		$this->loadModel('categorie');
		$this->loadModel('comment');
	}

	public function index(){
		$articles = $this->articleModel->getAll();
		$categories = $this->categorieModel->getAll();
		$this->render('article.index', compact('articles', 'categories'));
	}

	public function categories(){

		if(isset($_GET['id']) && !empty($_GET['id'])){
			$categorieId = (int) $_GET['id'];
			$articlesByCategorie = $this->articleModel->getByCategorie($categorieId);
			$categories = $this->categorieModel->getAll();
			$categorie = $this->categorieModel->get($categorieId);
		} else {
			$this->notFound();
		}
		if(empty($articlesByCategorie)){
			$this->notFound();
		}
		$this->render('article.categorie', compact('categorieId', 'articlesByCategorie', 'categories', 'categorie'));
	}

	public function show(){
		$message = '';
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$article_id = (int) $_GET['id'];
			$article = $this->articleModel->get($article_id);
			if($article === false){
				$this->notFound();
			}
		} else {
			$this->notFound();
		}
		if(isset($_POST['content'])&& isset($_POST['pseudo'])){
			$message = $_POST['content'];
			if(!empty($_POST['content']) && !empty($_POST['pseudo'])){
				if($this->commentModel->new()){
					$message = "Merci pour votre commentaire";
				} 
			} else {
				$message = "Votre commentaire ou votre pseudo est vide, votre commentaire ne peut être posté";
			}
		} else {
			$message = 'Rien';
		}
		$comments = $this->commentModel->findAllWithChildren($article->id); // 
		$this->app->setTitle($article->titre);
		$categories = $this->categorieModel->getAll();
		$this->render('article.single', compact('article_id', 'article', 'categories', 'comments', 'message'));
	}

}
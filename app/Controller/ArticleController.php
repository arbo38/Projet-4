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
		$articles = $this->articleModel->getLast(3);
		foreach ($articles as $key => $article) {
			$dateHeure = explode(' ', $article->date);
			$date = $dateHeure[0];
			$date = explode('-', $date);
			$date = $date[2] . '-' . $date[1] . '-' . $date[0];
			$articles[$key]->date = $date; 
		}
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
				return $this->notFound();
			} else {
				$comments = $this->commentModel->findAllWithChildren($article->id); // 
				$this->app->setTitle($article->titre);
			}
		} else {
			return $this->notFound();
		}
		if(isset($_POST['content'])&& isset($_POST['pseudo'])){
			$message = $_POST['content'];
			if(!empty($_POST['content']) && !empty($_POST['pseudo'])){
				if($this->commentModel->new()){
					$message = ['type' => 'success', 'message' => 'Merci pour votre commentaire'];
				} 
			} else {
				$message = ['type' => 'warning', 'message' => 'Votre commentaire ou votre pseudo est vide, votre commentaire ne peut être posté'];
			}
		} else {
			$message = '';
		}
		
		$categories = $this->categorieModel->getAll();
		$this->render('article.single', compact('article_id', 'article', 'categories', 'comments', 'message'));
	}

}
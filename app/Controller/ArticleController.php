<?php

namespace App\Controller;

use \App\Controller\AppController;
use \App;

/**
     * Controller gérant le rendu des pages liées aux articles
*/

class ArticleController extends AppController{

	public function __construct(){
		parent::__construct();
		// Chargement des Model propre au controller
		$this->loadModel('post');
		$this->loadModel('category');
		$this->loadModel('comment');
	}

	/**
     * Affiche la page index
     */

	public function index(){
		$posts = $this->postModel->getLast(3);
		foreach ($posts as $key => $post) {
			// Reformatage de la date en français
			$dateHeure = explode(' ', $post->date);
			$date = $dateHeure[0];
			$date = explode('-', $date);
			$date = $date[2] . '-' . $date[1] . '-' . $date[0];
			$posts[$key]->date = $date; 
		}
		$categories = $this->categoryModel->getAll();
		$this->render('article.index', compact('posts', 'categories'));
	}

	/**
     * Affiche la page des articles appartenant à une catégorie
     */

	public function getPostsByCategory(){
		$message;
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$categoryId = (int) $_GET['id'];
			$postsByCategory = $this->postModel->getPostsByCategory($categoryId);
			$categories = $this->categoryModel->getAll();
			$category = $this->categoryModel->get($categoryId);
		} else {
			$this->notFound();
		}
		if(empty($articlesByCategorie)){
			$message = ['type' => 'warning', 'message' => 'Aucun article dans cette catégorie'];
		}
		$this->render('article.category', compact('categoryId', 'postsByCategory', 'categories', 'category'));
	}

	/**
     * Affiche la page d'un article
     */

	public function show(){
		$message = '';
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$post_id = (int) $_GET['id'];
			$post = $this->postModel->get($post_id);
			if($post === false){
				return $this->notFound();
			} else {
				// Si un commentaire a été signalé
				if(isset($_POST['report_comment'])){
					$commentId = (int) $_POST['report_comment'];
					$message = $this->commentModel->report($commentId);
				}
				// Si un commentaire a été posté : 
				if(isset($_POST['content'])&& isset($_POST['pseudo'])){
					if(!empty($_POST['content']) && !empty($_POST['pseudo'])){
						$message = $this->commentModel->add();
							
						
					} else {
						$message = ['type' => 'warning', 'message' => 'Votre commentaire ou votre pseudo est vide, votre commentaire ne peut être posté'];
					}
				} 
				$comments = $this->commentModel->getAllWithChildren($post->id); // 
				$this->app->setTitle($post->title);
			}
		} else {
			return $this->notFound();
		}
		$categories = $this->categoryModel->getAll();
		$this->render('article.single', compact('post_id', 'post', 'categories', 'comments', 'message'));
	}

}
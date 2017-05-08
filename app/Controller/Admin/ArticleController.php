<?php

namespace App\Controller\Admin;

/**
     * Controller gérant le rendu des pages liées à l'administration des articles
*/

class ArticleController extends AppController{


	public function __construct(){
		parent::__construct();
		// Chargement des Model propre au controller
		$this->loadModel('post');
		$this->loadModel('category');
		$this->loadModel('comment');
	}

	public function index(){
		$message = '';
		if(!empty($_POST)){
			if(isset($_POST['deleteArticle'])){
				if($this->postModel->get($_POST['deleteArticle'])){
					$this->commentModel->deleteFromArticle($_POST['deleteArticle']);
					if($this->postModel->delete($_POST['deleteArticle'])){
						$message = ['type' => 'success', 'message' => 'L\'article a bien été supprimé'];
						
					}
				}
			}
			if(isset($_POST['deleteCategory'])){
				if($this->categoryModel->get($_POST['deleteCategory'])){
					if(empty($this->postModel->getPostsByCategory($_POST['deleteCategory']))){
						if($this->categoryModel->delete($_POST['deleteCategory'])){
						$message = ['type' => 'success', 'message' => 'La catégorie a bien été supprimé'];
						} else {
							$message = ['type' => 'warning', 'message' => 'Une erreur est survenue'];
						}
					} else {
						$message = ['type' => 'danger', 'message' => 'Vous ne pouvez pas supprimer cette catégorie, des articles y sont associés.'];
						}
					}
			}
		}
		$posts = $this->postModel->getAll();
		$lastPosts = $this->postModel->getLast(5);
		$categories = $this->categoryModel->getAll();
		$lastComments = $this->commentModel->getLast(10);
		$reportedComments = $this->commentModel->getReportedComments();
		$commentsByArticle = $this->commentModel->getAllByPosts($posts);
		$this->render('admin.index', compact('posts', 'categories', 'message', 'lastComments', 'commentsByArticle', 'lastPosts', 'reportedComments'));
	}

	public function newArticle(){
		$categories = $this->categoryModel->extraction('id', 'title');
		$form = new \Core\HTML\BootstrapForm();

		if(!empty($_POST)){
			$title = (string) $_POST['title'];
			$content = (string) $_POST['content'];
			$category_id = (int) $_POST['category_id'];
			$new = $this->postModel->add(['title' => $title, 'content' => $content, 'category_id' => $category_id]);
			if($new){
				$_SESSION['new'] = true;
				unset($_SESSION['new']);
				$message = ['type' => 'success', 'message' => 'L\'article a bien été créé'];
			}
		}
		$this->render('admin.article.create', compact('form', 'categories', 'message'));
	}

	public function editArticle(){
		$message = '';
		$categories = $this->categoryModel->extraction('id', 'title');
	// On regarde si l'on doit mettre à jour un article avec la présence de données en POST et d'un ID en get
		if(!empty($_POST) && !empty($_GET)){
			$title = (string) $_POST['title'];
			$content = (string) $_POST['content'];
			$category_id = (int) $_POST['category_id'];
			$articleId = (int) $_GET['id'];
			$update = $this->postModel->update($articleId, ['title' => $title, 'content' => $content, 'category_id' => $category_id]);
			if($update){
				$message = ['type' => 'success', 'message' => 'L\'article a bien été mis à jour.'];
			}
		}
	// On regarde si l'on vient éditer un article avec la présence d'un id
		if(!empty($_GET)){ 
			$articleId = (int) $_GET['id'];
			$article = $this->postModel->get($articleId);
			if(isset($_SESSION['new'])){
				if($_SESSION['new']){
					unset($_SESSION['new']);
					$message = ['type' => 'success', 'message' => 'L\'article a bien été créé.'];

				}
			}
		} else {
			$message = ['type' => 'warning', 'message' => 'Aucun article sélectionné'];
		}
		$form = new \Core\HTML\BootstrapForm($article);
		$this->render('admin.article.edit', compact('form', 'categories', 'message'));
	}
}
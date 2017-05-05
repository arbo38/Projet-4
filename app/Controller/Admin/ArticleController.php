<?php

namespace App\Controller\Admin;

class ArticleController extends AppController{
	public function __construct(){
		parent::__construct();
		$this->loadModel('article');
		$this->loadModel('categorie');
		$this->loadModel('comment');
	}

	public function index(){
		$message = '';
		if(!empty($_POST)){
			if(isset($_POST['deleteArticle'])){
				if($this->articleModel->get($_POST['deleteArticle'])){
					if($this->articleModel->delete($_POST['deleteArticle'])){
						$message = "
						<div class='alert alert-success'>
							L'article a bien été supprimé
						</div> <!-- div.alert alert-success -->";
						
					}
				}
			}
			if(isset($_POST['deleteCategorie'])){
				if($this->categorieModel->get($_POST['deleteCategorie'])){
					if($this->categorieModel->delete($_POST['deleteCategorie'])){
						$message = "
						<div class='alert alert-success'>
							La catégorie a bien été supprimé
						</div> <!-- div.alert alert-success -->";
					}
				}
			}
		}
		$articles = $this->articleModel->getAll();
		$categories = $this->categorieModel->getAll();
		$lastComments = $this->commentModel->findLast(5);
		$commentsByArticle = $this->commentModel->findAllByArticle($articles);
		$this->render('admin.index', compact('articles', 'categories', 'message', 'lastComments', 'commentsByArticle'));
	}

	public function newArticle(){
		$categories = $this->categorieModel->extraction('id', 'categorie');
		$form = new \Core\HTML\BootstrapForm();

		if(!empty($_POST)){
			$titre = (string) $_POST['titre'];
			$contenu = (string) $_POST['contenu'];
			$categorie_id = (int) $_POST['categorie_id'];
			$new = $this->articleModel->new(['titre' => $titre, 'contenu' => $contenu, 'categorie_id' => $categorie_id]);
			if($new){
				$_SESSION['new'] = true;
				header('Location: index.php?page=article.edit&id='.$this->app->getDb()->lastInsertId());
			}
		}
		$this->render('admin.article.create', compact('form', 'categories'));
	}

	public function editArticle(){
		$message = '';
		$categories = $this->categorieModel->extraction('id', 'categorie');
	// On regarde si l'on doit mettre à jour un article avec la présence de données en POST et d'un ID en get
		if(!empty($_POST) && !empty($_GET)){
			$titre = (string) $_POST['titre'];
			$contenu = (string) $_POST['contenu'];
			$categorie_id = (int) $_POST['categorie_id'];
			$articleId = (int) $_GET['id'];
			$update = $this->articleModel->update($articleId, ['titre' => $titre, 'contenu' => $contenu, 'categorie_id' => $categorie_id]);
			if($update){
				$message = "
				<div class='alert alert-success'>
					L'article a bien été mis à jour.
				</div> <!-- div.alert alert-success -->";
			}
		}
	// On regarde si l'on vient éditer un article avec la présence d'un id
		if(!empty($_GET)){ 
			$articleId = (int) $_GET['id'];
			$article = $this->articleModel->get($articleId);
			if(isset($_SESSION['new'])){
				if($_SESSION['new']){
					unset($_SESSION['new']);
					$message = "
					<div class='alert alert-success'>
						L'article a bien été créé.
					</div> <!-- div.alert alert-success -->
					";	
				}
			}
		} else {
			$message = "
			<div class='alert alert-warning'>
				Aucun article sélectionné
			</div> <!-- div.alert alert-success -->
			";
		}
		$form = new \Core\HTML\BootstrapForm($article);
		$this->render('admin.article.edit', compact('form', 'categories', 'message'));
	}
}
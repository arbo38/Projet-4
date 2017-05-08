<?php

namespace App\Controller\Admin;

/**
     * Controller gérant le rendu des pages liées à l'administration des catégories
*/

class CategoryController extends AppController{

	public function __construct(){
		parent::__construct();
		// Chargement des Model propre au controller
		$this->loadModel('post');
		$this->loadModel('category');
	}

	public function newCategory(){
		$form = new \Core\HTML\BootstrapForm();
		if(!empty($_POST)){
			$category = (string) $_POST['categorie'];
			$new = $this->categoryModel->add(['title' => $category]);
			if($new){
				$_SESSION['new'] = true;
				header('Location: admin.php?page=category.edit&id='.$this->app->getDb()->lastInsertId());
			}
		}
		$this->render('admin.category.create', compact('form'));
	}

	public function editCategory(){
		$message = '';
	// On regarde si l'on doit mettre à jour une categorie avec la présence de données en POST 'ET' d'un ID en get
		if(!empty($_POST) && !empty($_GET)){
			$category = (string) $_POST['title'];
			$categoryId = (int) $_GET['id'];
			$update = $this->categoryModel->update($categoryId, ['title' => $category]);
			if($update){
				$message = ['type' => 'success', 'message' => 'La catégorie a bien été mis à jour.'];
				
			}
		}
	// Sinon on vient pour éditer une catégorie
		if(!empty($_GET)){ 
			$categoryId = (int) $_GET['id'];
			$category = $this->categoryModel->get($categoryId);
			if(isset($_SESSION['new'])){
				if($_SESSION['new']){
					unset($_SESSION['new']);
					$message = ['type' => 'success', 'message' => 'La catégorie a bien été créé.'];
				}
			}
		} else {
			$message = ['type' => 'warning', 'message' => 'Aucune categorie sélectionné'];
		}
		$form = new \Core\HTML\BootstrapForm($category);
		$this->render('admin.category.edit', compact('form', 'message'));
	}
}
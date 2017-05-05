<?php

namespace App\Controller\Admin;

class CategorieController extends AppController{

	public function __construct(){
		parent::__construct();
		$this->loadModel('article');
		$this->loadModel('categorie');
	}

	public function newCategorie(){
		$form = new \Core\HTML\BootstrapForm();
		if(!empty($_POST)){
			$categorie = (string) $_POST['categorie'];
			$new = $this->categorieModel->new(['categorie' => $categorie]);
			if($new){
				$_SESSION['new'] = true;
				header('Location: admin.php?page=categorie.edit&id='.$this->app->getDb()->lastInsertId());
			}
		}
		$this->render('admin.categorie.create', compact('form'));
	}

	public function editCategorie(){
		$message = '';
	// On regarde si l'on doit mettre à jour une categorie avec la présence de données en POST et d'un ID en get
		if(!empty($_POST) && !empty($_GET)){
			$categorie = (string) $_POST['categorie'];
			$categorieId = (int) $_GET['id'];
			$update = $this->categorieModel->update($categorieId, ['categorie' => $categorie]);
			if($update){
				$message = "
				<div class='alert alert-success'>
					La catégorie a bien été mis à jour.
				</div> <!-- div.alert alert-success -->
				";
				
			}
		}
	// On regarde si l'on vient pour éditer un article avec la présence d'un id
		if(!empty($_GET)){ 
			$categorieId = (int) $_GET['id'];
			$categorie = $this->categorieModel->get($categorieId);
			if(isset($_SESSION['new'])){
				if($_SESSION['new']){
					unset($_SESSION['new']);
					$message = "
					<div class='alert alert-success'>
						La catégorie a bien été créé.
					</div> <!-- div.alert alert-success -->
					";
				}
			}
		} else {
			$message = "
			<div class='alert alert-warning'>
				Aucune categorie sélectionné
			</div> <!-- div.alert alert-success -->

			";
		}
		$form = new \Core\HTML\BootstrapForm($categorie);
		var_dump('troll');
		$this->render('admin.categorie.edit', compact('form', 'message'));
	}
}
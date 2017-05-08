<?php

namespace App\Controller\Admin;

/**
     * Controller gérant le rendu des pages liées à l'administration des commentaires
*/

class CommentController extends AppController{
	public function __construct(){
		parent::__construct();
		// Chargement des Model propre au controller
		$this->loadModel('post');
		$this->loadModel('category');
		$this->loadModel('comment');
	}

	public function editComment(){
		$message = '';
	// On regarde si l'on doit mettre à jour un commentaire avec la présence de données en POST et d'un ID en get
		if(!empty($_POST) && !empty($_GET)){
			if(isset($_POST['pseudo']) && isset($_POST['comment']) && isset($_GET['id'])){
				$pseudo = (string) $_POST['pseudo'];
				$content = (string) $_POST['comment'];
				$commentId = (int) $_GET['id'];
				$update = $this->commentModel->update($commentId, ['pseudo' => $pseudo, 'comment' => $content]);
				if($update){
					$message = ['type' => 'success', 'message' => 'Le commentaire a été mis à jour'];
				}
			} else {
				$message = ['type' => 'danger', 'message' => 'Une erreur est survenue'];
			}
		} else {
			$this->notFound();
		}

		if(!empty($_GET)){
			$commentId = (int) $_GET['id'];
			$comment = $this->commentModel->get($commentId);
		} else {
				$message = ['type' => 'danger', 'message' => 'Une erreur est survenue'];
		}
		$form = new \Core\HTML\BootstrapForm($comment);
		$this->render('admin.comment.edit', compact('form', 'comment', 'message'));
		}

	public function deleteComment(){
		$message = '';
		if(!empty($_POST)){
			if(isset($_POST['deleteComment']) && isset($_POST['deleteMethod'])){
				$commentId = (int) $_POST['deleteComment'];
				$deleteMethod = (string) $_POST['deleteMethod'];
				if($deleteMethod == 'simple'){
					if($this->commentModel->delete($commentId)){
						$message = ['type' => 'success', 'message' => 'Le commentaire a bien été supprimé'];
					} else {
						$message = ['type' => 'danger', 'message' => 'Une erreur est survenue'];
					}
				} elseif($deleteMethod == 'cascade'){
					if($this->commentModel->deleteWithChildren($commentId)){
						$message = ['type' => 'success', 'message' => 'Le message et ses réponses ont été supprimé'];
					} else {
						$message = ['type' => 'danger', 'message' => 'Une erreur est survenue'];
					}
				} else {
					$message = ['type' => 'danger', 'message' => 'Une erreur est survenue'];
				}
			}
		} else {
			$message = ['type' => 'danger', 'message' => 'Une erreur est survenue'];
		}
		$this->render('admin.comment.delete', compact('message'));
	}
}
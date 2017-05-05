<?php

namespace App\Controller\Admin;

class CommentController extends AppController{
	public function __construct(){
		parent::__construct();
		$this->loadModel('article');
		$this->loadModel('categorie');
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
					$message = 'success';
				}
			} else {
				$message = 'error-update';
			}
		}

		if(!empty($_GET)){
			$commentId = (int) $_GET['id'];
			$comment = $this->commentModel->find($commentId);
		} else {
				$message = 'error';
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
						$message = 'success';
					} else {
						$message = 'error';
					}
				} elseif($deleteMethod == 'cascade'){
					if($this->commentModel->deleteWithChildren($commentId)){
						$message = 'success-cascade';
					} else {
						$message = 'error';
					}
				} else {
					$message = 'error';
				}
			}
		} else {
			$message = 'error';
		}
		$this->render('admin.comment.delete', compact('message'));
	}
}
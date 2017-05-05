<?php
	 if($message == 'success'){
	 	$message = "
				<div class='alert alert-success temp'>
					Le commentaire a bien été supprimé.
				</div> <!-- div.alert alert-success -->";
	 } elseif ($message == 'success-cascade') {
	 	$message = "
				<div class='alert alert-success temp'>
					Le commentaire a bien été supprimé ainsi que ses réponses.
				</div> <!-- div.alert alert-success -->";
	 } elseif ($message == 'error') {
	 	$message = "
				<div class='alert alert-danger temp'>
					Une erreur est survenue.
				</div> <!-- div.alert alert-success -->";
	 } else {
	 	$message = "";
	 }

?>
<?= $message ?>

<h1>Page de suppression des articles</h1>

<a class='btn btn-primary' href="?page=admin.article.index">Retour au panneau d'administration</a>
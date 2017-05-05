<H1>Edition des commentaires</H1>

<?php
	 if($message == 'success'){
	 	$message = "
				<div class='alert alert-success temp'>
					Le commentaire a bien été mis à jour.
				</div> <!-- div.alert alert-success -->";
	 } elseif ($message == 'error-update') {
	 	$message = "
				<div class='alert alert-danger temp'>
					Une erreur est survenue lors de la mise à jour du commentaire, merci de réessayer.
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

<form method="post" action="">
	<?= $form->input('pseudo', 'Pseudo'); ?>
	<?= $form->input('comment', 'Contenu', ['type' => 'textarea']); ?>
	<?= $form->submit(); ?>
</form>
<?php

?>

<h1>Création d'articles</h1>

<form method="post">
	<?= $form->input('titre', 'Titre') ?>
	<?= $form->input('contenu', 'Article', ['type' => 'textarea']) ?>
	<?= $form->select('categorie_id', 'Categorie', $categories); ?>
	<?= $form->submit() ?>
</form>


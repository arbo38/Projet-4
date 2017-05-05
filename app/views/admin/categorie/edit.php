<?php

?>

<h1>Edition de catégorie</h1>

<?= $message ?>

<form method="post" action="">
	<?= $form->input('categorie', 'Nom de la catégorie'); ?>
	<?= $form->submit(); ?>
</form>


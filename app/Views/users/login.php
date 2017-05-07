<form method="post">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de pass', ['type' => 'password']); ?>
	<?= $form->submit(); ?>

</form>
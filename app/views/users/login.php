
<?php
if($message === 'error'){
	echo "<div class='alert alert-danger'>
			Identifiants incorrect
		</div> <!-- div.alert alert-danger -->";
}
?>
<form method="post">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de pass', ['type' => 'password']); ?>
	<?= $form->submit(); ?>

</form>
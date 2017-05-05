

<div class="row">
	<div class="col-sm-6">
		<h1>Edition des commentaires</h1>
	</div> <!-- div.col-sm-6 -->
	
	<div class="col-sm-6">
		<a class='btn btn-primary' href="?page=admin.article.index">
			Retour au panneau d'administration
		</a>
	</div> <!-- div.col-sm-6  -->
</div>

<form method="post" action="">
	<?= $form->input('pseudo', 'Pseudo'); ?>
	<?= $form->input('comment', 'Contenu', ['type' => 'textarea']); ?>
	<?= $form->submit(); ?>
</form>
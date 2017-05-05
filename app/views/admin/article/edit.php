<div class="row">
	<div class="col-sm-6">
		<h1>Edition des articles</h1>
	</div> <!-- div.col-sm-6 -->
	
	<div class="col-sm-6">
		<a class='btn btn-primary' href="?page=admin.article.index">
			Retour au panneau d'administration
		</a>
	</div> <!-- div.col-sm-6 -->
</div> <!-- div.row -->

<form method="post" action="">
	<?= $form->input('titre', 'Titre de l\'article'); ?>
	<?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
	<?= $form->select('categorie_id', 'Categorie', $categories); ?>
	<?= $form->submit(); ?>
</form>
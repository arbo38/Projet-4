
<div class="row">
	<div class="col-sm-6">
		<h1>Création d'articles</h1>
	</div> <!-- div.col-sm-6 -->
	
	<div class="col-sm-6">
		<a class='btn btn-primary' href="?page=admin.article.index">
			Retour au panneau d'administration
		</a>
	</div> <!-- div.col-sm-6 -->
</div> <!-- div.row -->



<form method="post">
	<?= $form->input('title', 'Titre') ?>
	<?= $form->input('content', 'Article', ['type' => 'textarea']) ?>
	<?= $form->select('category_id', 'Categorie', $categories); ?>
	<?= $form->submit() ?>
</form>


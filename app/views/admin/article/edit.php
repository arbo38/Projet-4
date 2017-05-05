<h1>Page d'édition des articles</h1>
<a class='btn btn-primary' href="?page=admin.article.index">Retour au panneau d'administration</a>

<?= $message ?>

<form method="post" action="">
	<?= $form->input('titre', 'Titre de l\'article'); ?>
	<?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
	<?= $form->select('categorie_id', 'Categorie', $categories); ?>
	<?= $form->submit(); ?>
</form>
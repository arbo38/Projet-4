
<?php


?>

<div class="row">
	<div class="col-sm-8">
		<ul>
		<?php foreach ($articles as $article): ?>
				<h2><a href="<?= $article->getURL(); ?>"><?= $article->titre; ?></a></h2>
				<p><em><?= $article->categorie ?></em></p>
				<p><?= $article->date ?></p>


				<p>
					<?= $article->getExtrait(); ?>
				</p>

			<?php endforeach; ?>
		
			
		</ul>
		
	</div> <!-- div.col-sm-8 -->

	<div class="col-sm-4">
	<?php 
		foreach ($categories as $categorie): ?>
			<p><a href="<?= $categorie->url ?>">
				<?= $categorie->categorie ?>
			</a></p>
		<?php endforeach; ?>
		
		
	</div> <!-- div.col-sm-4 -->

</div> <!-- div.row -->

<?php 

/*

foreach (App::getInstance()->getTable('articles')->getAll() as $article): ?>
				<? var_dump($article) ?>
				<!--<h2><?= $article->getLink() ?></h2>-->
				<p><em><?= $article->categorie ?></em></p>
				<p><?= $article->date ?></p>


				<p>
					<?= $article->getExtrait(); ?>
				</p>

			<?php endforeach; ?>

			<?php 
		$categories = App\Table\Categorie::all();
		foreach ($categories as $categorie): ?>
			<p><a href="<?= $categorie->getURL() ?>">
				<?= $categorie->categorie ?>
			</a></p>
		<?php endforeach; 

		*/
		?>



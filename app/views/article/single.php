<div class="row">
	<div class="col-sm-8">
		<ul>
			<h2><?= $article->titre ?></h2>
			<p><em><?= $article->categorie ?></em></p>


			<p>
				<?= $article->contenu; ?>
			</p>
		</ul>
		
	</div> <!-- div.col-sm-8 -->

	<div class="col-sm-4">
		<?php 
		
		foreach ($categories as $categorie): ?>
		<p><a href="<?= $categorie->getURL() ?>">
			<?= $categorie->categorie ?>
		</a></p>
	<?php endforeach; ?>

</div> <!-- div.col-sm-4 -->

</div> <!-- div.row -->
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<?php foreach($comments as $comment): ?>
			<?php require(ROOT . '/app/views/comment/comments.php'); ?>
		<?php endforeach; ?>

		<form action="" id="form-comment" method="post">
			<input type="hidden" name="parent_id" value="0" id="parent_id">
			<input type="hidden" name="post_id" value="<?= $article->id ?>" id="post_id">
			<h4>Poster un commentaire</h4>       
			<div class="form-group">
				<textarea name="content" id="content" class="form-control" placeholder="Votre commentaire" required></textarea>
			</div>
			<div class="form-group">
				<label for="pseudo">Pseudo</label> <input type="text" name="pseudo" id="pseudo" required>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Commenter</button>
			</div>
		</form>
		
	</div> <!-- div.col-sm-6 col-sm-offset-3 -->
	
</div> <!-- div.row -->




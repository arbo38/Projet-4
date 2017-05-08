<div class="row">
	<div class="col-sm-8">
		<ul>
			<h2><?= $post->title ?></h2>
			<p><em><?= $post->category ?></em></p>


			<p>
				<?= $post->content; ?>
			</p>
		</ul>
		
	</div> <!-- div.col-sm-8 -->

	<div class="col-sm-4">
		<div class="widget-wrapper wow fadeIn" data-wow-delay="0.4s">
			<h4>Categories:</h4>
			<br>
			<div class="list-group">
				<?php 
				foreach ($categories as $category): ?>
				<a class="list-group-item" href="<?= $category->url ?>">
					<?= $category->title ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="widget-wrapper wow fadeIn" data-wow-delay="0.6s">
		<h4>Subscription form:</h4>
		<br>
		<div class="card">
			<div class="card-block">
				<p><strong>Suivre ce blog</strong></p>
				<p>Restez informé des nouveaux articles et des actualités du blog en vous inscrivant à la newsletter</p>
				<div class="md-form">
					<i class="fa fa-user prefix"></i>
					<input type="text" id="form1" class="form-control">
					<label for="form1">Votre nom</label>
				</div>
				<div class="md-form">
					<i class="fa fa-envelope prefix"></i>
					<input type="text" id="form2" class="form-control">
					<label for="form2">Votre email</label>
				</div>
				<button class="btn btn-info">Envoyer</button>

			</div>
		</div>
	</div>
</div> <!-- div.col-sm-4 -->


</div> <!-- div.row -->
<div class="row">
	<h3 class="col-sm-6 offset-sm-1">Commentaires: </h3>
	<div class="col-sm-6 offset-sm-1">
		<?php foreach($comments as $comment): ?>
			<?php require(ROOT . '/app/Views/comment/comments.php'); ?>
		<?php endforeach; ?>
		<div class="card" id="form-comment" style="margin-bottom: 20px;">
			<!--Card content-->
			<div class="card-block">

				<form action=""  method="post">
					<input type="hidden" name="parent_id" value="0" id="parent_id">
					<input type="hidden" name="post_id" value="<?= $post->id ?>" id="post_id">
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
			</div>
			<!--/.Card content-->

		</div>
		<!--/.Card-->

	</div> <!-- div.col-sm-6 col-sm-offset-3 -->

</div> <!-- div.row -->




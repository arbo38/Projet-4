<h1><?= $categorie->categorie ?></h1>

<div class="row">
	<div class="col-sm-8">
		<ul>
			<?php foreach ($articlesByCategorie as $article): ?>
				<h2><a href="<?= $article->getURL() ?>"><?= $article->titre ?></a></h2>
				<p><em><?= $article->categorie ?></em></p>


				<p>
					<?= $article->getExtrait(); ?>
				</p>

			<?php endforeach; ?>


		</ul>
		
	</div> <!-- div.col-sm-8 -->

	<div class="col-sm-4">
		<div class="widget-wrapper wow fadeIn" data-wow-delay="0.4s">
			<h4>Categories:</h4>
			<br>
			<div class="list-group">
				<?php 
				foreach ($categories as $categorie): ?>
				<a class="list-group-item" href="<?= $categorie->url ?>">
					<?= $categorie->categorie ?>
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

</div>  <!-- div.col-sm-4 -->

<!-- </div>  --><!-- div.row -->

<h1><?= $category->title ?></h1>

<div class="row">
	<div class="col-sm-8">
		<ul>
			<?php foreach ($postsByCategory as $post): ?>
				<h2><a href="<?= $post->getURL() ?>"><?= $post->title ?></a></h2>
				<p><em><?= $post->category ?></em></p>


				<p>
					<?= $post->getExtrait(); ?>
				</p>

			<?php endforeach; ?>


		</ul>
		
	</div> <!-- div.col-sm-8 -->

	<div class="col-sm-4">
		<div class="widget-wrapper">
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

	<div class="widget-wrapper">
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

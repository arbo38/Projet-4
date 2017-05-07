<div class="row">
	<!--Main column-->
	<div class="col-lg-8">
		<?php foreach ($articles as $article): ?>
			<h1 class="h1-responsive"><a href="<?= $article->getURL(); ?>"><?= $article->titre; ?></a> - <small class="text-muted"><?= $article->categorie ?></small></h1>
			<h5>Auteur: <a href="">Jean Forteroche</a>, le <?= $article->date ?></h5>
			<br>
			<!--Featured image -->
			<div class="view overlay hm-white-light z-depth-1-half">
				<img src="http://mdbootstrap.com/img/Photos/Slides/img%20(116).jpg" class="img-fluid " alt="">
				<div class="mask">
				</div>
			</div>

			<?= $article->getExtrait(); ?>

		<?php endforeach; ?>

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

</div> <!-- div.row -->

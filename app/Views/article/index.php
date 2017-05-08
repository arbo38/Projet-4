<div class="row">
	<!--Main column-->
	<div class="col-lg-8">
		<?php foreach ($posts as $post): ?>
			<h1 class="h1-responsive"><a href="<?= $post->getURL(); ?>"><?= $post->title; ?></a> - <small class="text-muted"><?= $post->category ?></small></h1>
			<h5>Auteur: <a href="">Jean Forteroche</a>, le <?= $post->date ?></h5>
			<br>
			<!--Featured image -->
			<div class="view overlay hm-white-light z-depth-1-half">
				<img src="http://mdbootstrap.com/img/Photos/Slides/img%20(116).jpg" class="img-fluid " alt="">
				<div class="mask">
				</div>
			</div>

			<?= $post->getExtrait(); ?>

		<?php endforeach; ?>

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

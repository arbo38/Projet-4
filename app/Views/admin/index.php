
<h1>Panneau d'administration</h1>

<div class="row">



	<div class="col-sm-6">
		<hr />
		<h4>Les 5 derniers articles</h4>
		<hr />

		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<td style="width: 10%;">ID</td>
					<td style="width: 15%;">Catégorie</td>
					<td style="width: 50%;">Titre</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($lastPosts as $post) {
					$id = $post->id;
					$title = $post->title;
					$actions = "
					<a class='btn btn-primary ' href='?page=article.edit&id=$id'>Editer
					</a>
					<form method='post' style='display:inline;'>
						<input type='hidden' name='deleteArticle' value='$id'/>
						<button class='btn btn-warning btn-sm suppressionArticle'>Supprimer</button>
					</form>
					";
					$html = "
					<tr>
						<td>$id</td>
						<td>$post->category</td>
						<td>$title</td>
						<td><div class='text-center'>$actions</div></td>
					</tr>";
					echo $html;
				}
				?>
			</tbody>
		</table> <!-- table.table -->
		<a class="btn btn-success" href="?page=article.create">Ajouter un article</a>
	</div> <!-- div.col-sm-6 -->
	<div class="col-sm-6">
		<hr />
		<h4>Les 10 derniers commentaires</h4>
		<hr />

		<div class="panel-group" id="commentAccordion" role="tablist" aria-multiselectable="true">
			
			<?php foreach ($lastComments as $comment) {
				$heading = 'heading-comment-' . $comment->id;
				$identifier = 'comment-' . $comment->id;
				$html = '<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="'.$heading.'">
					<h5 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#commentAccordion" href="#'.$identifier.'" aria-expanded="true" aria-controls="collapseOne">
							Commentaire numéro '.$comment->id.' de <em>'.$comment->pseudo.'</em>, article <em>'.$comment->articleTitle.' </em>
						</a>
					</h5>
				</div>
				<div id="'.$identifier.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="'.$heading.'">
					<div class="panel-body">
						<p>'.$comment->content.'</p>
						<div>
							<a class="btn btn-primary btn-sm" href="?page=comment.edit&id='.$comment->id.'">Editer
							</a>
							<div>
								<form method="post" action="?page=comment.delete" style="display:inline;">
									<input type="hidden" name="deleteComment" value="'.$comment->id.'"/>
									<input type="hidden" name="deleteMethod" value="simple"/>
									<button class="btn btn-warning btn-sm suppressionCommentaire">Supprimer</button>
								</form>
							</div>
							<div>
								<form method="post" action="?page=comment.delete" style="display:inline;">
									<input type="hidden" name="deleteComment" value="'.$comment->id.'"/>
									<input type="hidden" name="deleteMethod" value="cascade"/>
									<button class="btn btn-danger btn-sm suppressionCommentaire">Supprimer en cascade</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>';
			echo $html;
		} ?>
	</div>
</div>
</div> <!-- div.row -->


<div class="row">
	<div class="col-sm-12">
		<hr />
		<h2>Administrer les articles</h2>
		<hr />
		<!-- Nav tabs -->
		<form>
			<select class="form-control">
				<?php 
				foreach($posts as $post){
					$html = '<option data-article-id="article_id_'.$post->id.'" class="article_selector" >'.$post->title.' - article N° '.$post->id.'</option>';
					echo $html;
				}
				?>
			</select>
		</form>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<td style="width: 10%;">ID</td>
					<td style="width: 15%;">Catégorie</td>
					<td style="width: 50%;">Titre</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($lastPosts as $post) {
					$id = $post->id;
					$title = $post->title;
					$actions = "
					<a class='btn btn-primary ' href='?page=article.edit&id=$id'>Editer
					</a>
					<form method='post' style='display:inline;'>
						<input type='hidden' name='deleteArticle' value='$id'/>
						<button class='btn btn-warning btn-sm suppressionArticle'>Supprimer</button>
					</form>
					";
					$html = "
					<tr class='admin-articles' id='article_id_".$post->id."'>
						<td>$id</td>
						<td>$post->category</td>
						<td>$title</td>
						<td><div class='text-center'>$actions</div></td>
					</tr>";
					echo $html;
				}
				?>
			</tbody>
		</table> <!-- table.table -->







		<a class="btn btn-success" href="?page=article.create">Ajouter un article</a>
	</div> <!-- div.col-sm-12 -->
</div> <!-- div.row -->
<div class="row">
	<div class="col-sm-12">
		<hr />
		<h2>Administrer les catégories</h2>
		<hr />

		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<td>ID</td>
					<td style="width: 60%;">Titre</td>
					<td >Actions</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($categories as $category) {
					$id = $category->id;
					$category = $category->title;
					$actions = "
					<a class='btn btn-primary' href='?page=category.edit&id=$id'>Editer
					</a>
					<form method='post' style='display:inline;'>
						<input type='hidden' name='deleteCategory' value='$id'/>
						<button class='btn btn-warning btn-sm suppressionCategorie'>Supprimer</button>
					</form>
					";
					$html = "
					<tr>
						<td>$id</td>
						<td>$category</td>
						<td><div class='text-center'>$actions</div></td>
					</tr>";
					echo $html;
				}
				?>
			</tbody>
		</table> <!-- table.table -->
		<a class="btn btn-success" href="?page=category.create">Ajouter une catégorie</a>
	</div> <!-- div.col-sm-6 -->
</div> <!-- div.row -->

<div class="row">
	<div class="col-sm-12">
		<h2>Administrer les commentaires</h2>
		<hr />

		<h3>Les commentaires signalés</h2>

			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<td>ID</td>
						<td>Auteur</td>
						<td style="width:50%;">Contenu</td>
						<td style="width:30%;">Actions</td>
					</tr>
				</thead>
				<tbody>

					<?php 
					foreach ($reportedComments as $reportedComment) {
						$actions = '<div>
						<a class="btn btn-primary btn-sm" href="?page=comment.edit&id='.$reportedComment->id.'">Editer
						</a>
						<div>
							<form method="post" action="?page=comment.delete" style="display:inline;">
								<input type="hidden" name="deleteComment" value="'.$reportedComment->id.'"/>
								<input type="hidden" name="deleteMethod" value="simple"/>
								<button class="btn btn-sm btn-warning suppressionCommentaire">Supprimer</button>
							</form>
						</div>
						<div>
							<form method="post" action="?page=comment.delete" style="display:inline;">
								<input type="hidden" name="deleteComment" value="'.$reportedComment->id.'"/>
								<input type="hidden" name="deleteMethod" value="cascade"/>
								<button class="btn btn-sm btn-danger suppressionCommentaire">Supprimer en cascade</button>
							</form>
						</div>
					</div>';
					$id = $reportedComment->id;
					$auteur = $reportedComment->pseudo;
					$contenu = $reportedComment->comment;
					$html = '<tr>
					<td>'.$id.'</td>
					<td>'.$auteur.'</td>
					<td>'.$contenu.'</td>
					<td><div class="">'.$actions.'</div></td>';
					echo $html;
				}
				?>

			</tbody>
		</table>

		<hr />

		<h3>Tous les commentaires</h2>
			<div>
				<!-- Nav tabs -->
				<form>
					<select class="form-control">
						<?php 
						foreach($commentsByArticle as $article => $comments){
							$articleData = explode('-', $article);
							$articleTitle = trim($articleData[0]);
							$articleId = trim($articleData[1]);

							$html = '<option data-article-id="comments_article_id_'.$articleId.'" class="article_comment" >'.$articleTitle.'</option>';
							echo $html;

						}
						?>
					</select>
				</form>
				<!-- Tab panes -->
				<div class="tab-content" style="margin-bottom: 200px;">
					<?php 
					foreach($commentsByArticle as $article => $comments){
						if(!empty($comments[0]->content)){
							$articleData = explode('-', $article);
							$articleTitle = trim($articleData[0]);
							$articleId = trim($articleData[1]);

							$html = '<div id="comments_article_id_'.$articleId.'" class="comments_list" style="display: none;" >';
							foreach ($comments as $comment) {
								$actions = '<div>
								<a class="btn btn-primary btn-sm" href="?page=comment.edit&id='.$comment->id.'">Editer
								</a>
								<div>
									<form method="post" action="?page=comment.delete" style="display:inline;">
										<input type="hidden" name="deleteComment" value="'.$comment->id.'"/>
										<input type="hidden" name="deleteMethod" value="simple"/>
										<button class="btn btn-sm btn-warning suppressionCommentaire">Supprimer</button>
									</form>
								</div>
								<div>
									<form method="post" action="?page=comment.delete" style="display:inline;">
										<input type="hidden" name="deleteComment" value="'.$comment->id.'"/>
										<input type="hidden" name="deleteMethod" value="cascade"/>
										<button class="btn btn-sm btn-danger suppressionCommentaire">Supprimer en cascade</button>
									</form>
								</div>
							</div>';
							$id = $comment->id;
							$auteur = $comment->pseudo;
							$contenu = $comment->content;
							$html .= '<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<td>ID</td>
									<td>Auteur</td>
									<td style="width:50%;">Contenu</td>
									<td style="width:30%;">Actions</td>
								</tr>
							</thead>
							<tbody>';
								$html .= '<tr>
								<td>'.$id.'</td>
								<td>'.$auteur.'</td>
								<td>'.$contenu.'</td>
								<td><div class="">'.$actions.'</div></td>
							</tr>';
							$html .= '</tbody>
						</table> <!-- table.table -->';

					}
					$html .= '</div>';
					echo $html;
				}

			}
			?>
		</div>
	</div>
</div> <!-- div.row -->


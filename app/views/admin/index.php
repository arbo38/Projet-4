

<h1>Panneau d'administration</h1>

<?= $message ?>

<div class="row">
	<div class="col-sm-6">
		<h2>Administrer les articles</h2>

		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<td>ID</td>
					<td>Catégorie</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($articles as $article) {
					$id = $article->id;
					$titre = $article->titre;
					$actions = "
					<a class='btn btn-primary' href='?page=article.edit&id=$id'>Editer
					</a>
					<form method='post' style='display:inline;'>
						<input type='hidden' name='deleteArticle' value='$id'/>
						<button class='btn btn-warning suppressionArticle'>Supprimer</button>
					</form>
					";
					$html = "
					<tr>
						<td>$id</td>
						<td>$titre</td>
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
		<h2>Administrer les catégories</h2>

		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<td>ID</td>
					<td>Titre</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($categories as $categorie) {
					$id = $categorie->id;
					$categorie = $categorie->categorie;
					$actions = "
					<a class='btn btn-primary' href='?page=categorie.edit&id=$id'>Editer
					</a>
					<form method='post' style='display:inline;'>
						<input type='hidden' name='deleteCategorie' value='$id'/>
						<button class='btn btn-warning suppressionCategorie'>Supprimer</button>
					</form>
					";
					$html = "
					<tr>
						<td>$id</td>
						<td>$categorie</td>
						<td><div class='text-center'>$actions</div></td>
					</tr>";
					echo $html;
				}
				?>
			</tbody>
		</table> <!-- table.table -->
		<a class="btn btn-success" href="?page=categorie.create">Ajouter une catégorie</a>
	</div> <!-- div.col-sm-6 -->
</div> <!-- div.row -->

<div class="row">
<h2>Administrer les commentaires</h2>
	<div class="col-sm-3">
		<div class="panel-group" id="commentAccordion" role="tablist" aria-multiselectable="true">
			<h4>Les 5 derniers commentaires</h4>
			<?php foreach ($lastComments as $comment) {
				$heading = 'heading-comment-' . $comment->id;
				$identifier = 'comment-' . $comment->id;
				$html = '<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="'.$heading.'">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#commentAccordion" href="#'.$identifier.'" aria-expanded="true" aria-controls="collapseOne">
							Commentaire numéro '.$comment->id.' de <em>'.$comment->pseudo.'</em>, article <em>'.$comment->articleTitle.' </em>
						</a>
					</h4>
				</div>
				<div id="'.$identifier.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="'.$heading.'">
					<div class="panel-body">
						<p>'.$comment->content.'</p>
						<div>
							<a class="btn btn-primary" href="?page=comment.edit&id='.$comment->id.'">Editer
							</a>
							<div>
							<form method="post" action="?page=comment.delete" style="display:inline;">
								<input type="hidden" name="deleteComment" value="'.$comment->id.'"/>
								<input type="hidden" name="deleteMethod" value="simple"/>
								<button class="btn btn-warning suppressionCommentaire">Supprimer</button>
							</form>
							</div>
							<div>
							<form method="post" action="?page=comment.delete" style="display:inline;">
								<input type="hidden" name="deleteComment" value="'.$comment->id.'"/>
								<input type="hidden" name="deleteMethod" value="cascade"/>
								<button class="btn btn-danger suppressionCommentaire">Supprimer en cascade</button>
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




<div class="col-sm-9">
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
	?>
		</div>
	</div>

</div> <!-- div.col-sm-6 -->
</div> <!-- div.row -->


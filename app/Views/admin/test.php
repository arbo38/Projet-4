<div class="col-sm-9">
	<h3>Tous les commentaires</h2>
	<div>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<?php 
			foreach($commentsByArticle as $article => $comments){
				$articleData = explode('-', $article);
				$articleTitle = trim($articleData[0]);
				$articleId = trim($articleData[1]);

				$html = '<li role="presentation"><a href="#comments_article_id_'.$articleId.'" aria-controls="home" role="tab" data-toggle="tab">'.$articleTitle.'</a></li>';
				echo $html;

			}
			?>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content" style="margin-bottom: 200px;">
			<?php 
			foreach($commentsByArticle as $article => $comments){
				$articleData = explode('-', $article);
				$articleTitle = trim($articleData[0]);
				$articleId = trim($articleData[1]);

				$html = '<div role="tabpanel" class="tab-pane" id="comments_article_id_'.$articleId.'" >';
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

<div class="panel panel-default" id="comment-<?= $comment->id; ?>">
	<div class="panel-body">
	<p><?= htmlentities($comment->comment); ?></p>
	<p class="text-primary"><em><?= htmlentities($comment->pseudo); ?></em></p>
		<?php if($comment->depth <= 2): ?>
			<p class="text-right">
				<button class="btn btn-default reply" data-id="<?= $comment->id; ?>">Répondre</button>
			</p>
		<?php endif; ?>
	</div>
</div>

<div style="margin-left: 50px;">
	<?php if(isset($comment->children)): ?>
		<?php foreach($comment->children as $comment): ?>
			<?php require(ROOT . '/app/views/comment/comments.php'); ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
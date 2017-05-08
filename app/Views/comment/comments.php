
<!--Card-->
<div class="card" id="comment-<?= $comment->id; ?>" style="margin-bottom: 20px;">
    <!--Card content-->
    <div class="card-block">
        <!--Title-->
        <h4 class="card-title"><?= $comment->pseudo; ?></h4>
        <!--Text-->
        <p class="card-text"><?= $comment->comment; ?></p>

        <?php if($comment->depth <= 1): ?>
            <button class="btn btn-default reply" data-id="<?= $comment->id; ?>">Répondre</button>
        <?php endif; ?>
        <form action=""  method="post">
            <input type="hidden" name="report_comment" value="<?= $comment->id; ?>">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-danger">Signaler</button>
            </div>
        </form>



    </div>
    <!--/.Card content-->

</div>
<!--/.Card-->

<div style="margin-left: 50px;">
	<?php if(isset($comment->children)): ?>
		<?php foreach($comment->children as $comment): ?>
			<?php require(ROOT . '/app/Views/comment/comments.php'); ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
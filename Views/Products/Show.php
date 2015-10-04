<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<section>
	<div>Name: <?php ViewEngine::show($model->getProduct()->getName()); ?></div>
	<div>Category: <?php ViewEngine::show($model->getProduct()->getCategoryName()); ?></div>
	<div>Description: <?php ViewEngine::show($model->getProduct()->getDescription()); ?></div>
</section>
<section>
	<?php Html::renderAction('Comments', 'newComment', array('productId' => $model->getProduct()->getId())) ?>
</section>
<section>
<?php foreach ($model->getComments() as $comment) { ?>
	<div class="comment">
		<div>Username: <?php ViewEngine::show($comment->getUsername()); ?></div>
		<div><?php ViewEngine::show($comment->getCommentDate()); ?></div>
		<div><?php ViewEngine::show($comment->getContent()); ?></div>
		<?php if ($model->getCanDeleteComment()) {
		echo Html::form('post', 'administrators/comments/delete/' . $comment->getId());
		echo Html::hidden('productId', $model->getProduct()->getId());
		echo Html::submit('btn btn-danger', 'Delete comment');
		echo Html::csrfToken();
		echo Html::formClose();
		} ?>
	</div>
<?php } ?>
</section>
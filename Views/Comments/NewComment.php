<?php  
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<h4>Create comment</h4>

<?php echo Html::form('post', 'comments/create'); ?>

<div class="form-group">
<?php 
echo Html::label('content', 'Comment:');
echo Html::textarea('form-control', 'content', $model->getContent(), 'Enter comment...'); 
?>
</div>
<div class="form-group">
<?php echo Html::submit('btn btn-default', 'Add comment'); ?>
</div>
<?php echo Html::hidden('productId', $model->getProductId()); ?>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>
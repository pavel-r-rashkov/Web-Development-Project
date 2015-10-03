<?php  
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<h4>Edit product <?php ViewEngine::show($model->getName()); ?></h4>

<?php echo Html::form('post', 'editors/products/update/' . $model->getId()); ?>

<div class="form-group">
<?php
echo Html::label('quantity', 'Quantity:');
echo Html::number('form-control', 'quantity', $model->getQuantity()); 
?>
</div>

<div class="form-group">
<?php 
echo Html::label('description', 'Description:');
echo Html::textarea('form-control', 'description', $model->getDescription(), 'Enter description...'); 
?>
</div>
<div class="form-group">
<?php 
echo Html::label('categoryId', 'Category:');
echo Html::select('categoryId', $model->getCategories(), 'form-control', $model->getCategoryId());
?>
</div>
<div class="form-group">
<?php echo Html::submit('btn btn-default', 'Edit product'); ?>
</div>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>
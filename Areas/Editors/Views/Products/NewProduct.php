<?php  
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<h4>Create product</h4>

<?php echo Html::form('post', 'editors/products/create'); ?>

<div class="form-group">
<?php
echo Html::label('name', 'Name:'); 
echo Html::inputField('form-control', 'name', '', 'Enter product name...');
?>
</div>
<div class="form-group">
<?php 
echo Html::label('quantity', 'Quantity:');
echo Html::number('form-control', 'quantity', 0); 
?>
</div>
<div class="form-group">
<?php 
echo Html::label('description', 'Description:');
echo Html::textarea('form-control', 'description', '', 'Enter description...'); 
?>
</div>
<div class="form-group">
<?php 
echo Html::label('categoryId', 'Category:');
echo Html::select('categoryId', $model->getCategories(), 'form-control');
?>
</div>
<div class="form-group">
<?php echo Html::submit('btn btn-default', 'Add product'); ?>
</div>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>
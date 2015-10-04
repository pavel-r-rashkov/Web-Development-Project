<?php  
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<h4>Create promotion</h4>

<?php echo Html::form('post', 'promotions/create'); ?>

<div class="form-group">
<?php
echo Html::label('name', 'Promotion name:'); 
echo Html::inputField('form-control', 'name', '', 'Enter promotion name...');
?>
</div>
<div class="form-group">
<?php 
echo Html::label('startDate', 'Start date:');
echo Html::datePicker('startDate', 'form-control');
?>
</div>
<div class="form-group">
<?php 
echo Html::label('endDate', 'End date:');
echo Html::datePicker('endDate', 'form-control');
?>
</div>
<div class="form-group">
<?php 
echo Html::label('discount', 'Discount:');
echo Html::number('form-control', 'discount', 0);
?>
</div>
<div class="form-group">
<?php 
echo Html::label('productId', 'Product:');
echo Html::select('productId', $model->getProducts(), 'form-control');
?>
</div>
<div class="form-group">
<?php 
echo Html::label('categoryId', 'Category:');
echo Html::select('categoryId', $model->getCategories(), 'form-control');
?>
</div>
<div class="form-group">
<?php 
echo Html::label('userCriteriaId', 'User criteria:');
echo Html::select('userCriteriaId', $model->getUserCriterias(), 'form-control');
?>
</div>
<div class="form-group">
<?php echo Html::submit('btn btn-default', 'Add promotion'); ?>
</div>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>
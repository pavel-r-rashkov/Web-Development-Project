<?php  
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<h4>Create sell</h4>

<?php echo Html::form('post', 'editors/sells/create'); ?>

<div class="form-group">
<?php 
echo Html::label('quantity', 'Price:');
echo Html::number('form-control', 'price', 0, 0.01);
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
echo Html::label('productId', 'Product:');
echo Html::select('productId', $model->getProducts(), 'form-control');
?>
</div>
<div class="form-group">
<?php echo Html::submit('btn btn-default', 'Add sell'); ?>
</div>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>
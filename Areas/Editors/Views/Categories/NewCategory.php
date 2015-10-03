<?php  
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<h4>Create category</h4>

<?php echo Html::form('post', 'editors/categories/create'); ?>

<div class="form-group">
<?php
echo Html::label('name', 'Name:'); 
echo Html::inputField('form-control', 'name', $model->getName(), 'Enter category name...');
?>
</div>
<div class="form-group">
<?php echo Html::submit('btn btn-default', 'Add category'); ?>
</div>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>
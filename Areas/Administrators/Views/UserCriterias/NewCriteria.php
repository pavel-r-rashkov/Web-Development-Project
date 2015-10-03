<?php  
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<h4>Create user criteria</h4>

<?php echo Html::form('post', 'administrators/usercriterias/create'); ?>

<div class="form-group">
<?php
echo Html::label('name', 'Name:'); 
echo Html::inputField('form-control', 'name', $model->getName(), 'Enter product name...');
?>
</div>
<div class="form-group">
<?php 
echo Html::label('minimumDaysRegistered', 'Minimum days registered:');
echo Html::number('form-control', 'minimumDaysRegistered', $model->getMinimumDaysRegistered()); 
?>
</div>
<div class="form-group">
<?php 
echo Html::label('minimumCash', 'Minimum cash:');
echo Html::number('form-control', 'minimumCash', $model->getMinimumCash()); 
?>
</div>
<div class="form-group">
<?php echo Html::submit('btn btn-default', 'Add product'); ?>
</div>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>
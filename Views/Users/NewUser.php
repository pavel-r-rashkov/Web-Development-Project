<?php  
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<h2>Register</h2>

<?php echo Html::form('post', 'users/create'); ?>

<div class="form-group">
<?php
echo Html::label('username', 'Username:'); 
echo Html::inputField('form-control', 'username', $model->getUsername(), 'Enter username...'); 
?>
</div>
<div class="form-group">
<?php 
echo Html::label('password', 'Password:');
echo Html::password('form-control', 'password', null, 'Enter password...'); 
?>
</div>
<div class="form-group">
<?php echo Html::submit('btn btn-default', 'Register'); ?>
</div>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>


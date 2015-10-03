<?php
use Core\ResultExecution\ViewEngine;  
use Core\HtmlHelpers\Html;
?>

<h2>Log in</h2>

<?php echo Html::form('post', 'sessions/create'); ?>

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
<?php echo Html::submit('btn btn-default', 'Log in'); ?>
</div>
<?php echo Html::csrfToken(); ?>

<?php echo Html::formClose() ?>
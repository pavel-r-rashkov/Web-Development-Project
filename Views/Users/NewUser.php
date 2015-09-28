<?php  
use Core\HtmlHelpers\Html;
?>

<h2>Register</h2>

<?php 
echo Html::form('post', 'users/create', 
	Html::inputField('username', $model->getUsername(), 'Enter username...') . 
	Html::password('password', null, 'Enter password...') .
	Html::submit('Register') .
	Html::csrfToken());
?>
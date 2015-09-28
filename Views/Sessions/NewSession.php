<?php  
use Core\HtmlHelpers\Html;
?>

<h2>Log in</h2>

<?php 
echo Html::form('post', 'sessions/create',
	Html::inputField('username', $model->getUsername(), 'Enter username...') . 
	Html::password('password', $model->getPassword(), 'Enter password...') .
	Html::submit('Log in') .
	Html::csrfToken());
?>
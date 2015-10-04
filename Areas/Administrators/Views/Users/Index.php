<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<section>
	<h4>Users: </h4>
	<div id="users-page">
		<?php Html::renderAction('users', 'paged', array('page' => $model), 'administrators') ?>
	</div>
</section>
<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<header>
	<?php Html::renderAction('navigation', 'show'); ?>	
	<h1 class="col-lg-10 col-lg-offset-1">My header</h1>
</header>
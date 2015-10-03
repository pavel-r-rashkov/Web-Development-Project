<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<header>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><?php echo Html::link('users/newuser', 'Register') ?></li>
					<li><?php echo Html::link('sessions/newsession', 'Log in') ?></li>
				</ul>
			</div>
		</div>
	</nav>
	<h1 class="col-lg-6 col-lg-offset-3">My header</h1>
	<div class="clearfix"></div>
	<div>======================================</div>
</header>
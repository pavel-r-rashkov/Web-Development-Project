<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<header>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><?php echo Html::link('register', 'Register') ?></li>
					<li><?php echo Html::link('login', 'Log in') ?></li>
				</ul>
			</div>
		</div>
	</nav>
	<h1 class="col-lg-6 col-lg-offset-3">Shop</h1>
	<div class="clearfix"></div>
</header>
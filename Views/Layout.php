<?php
use Core\HtmlHelpers\Html;
use Core\ResultExecution\ViewEngine;
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo APP_ROOT_URL ?>Content/BaseStyles.css">
	<title>Shop</title>
</head>
<body>
<div class="container-fluid">
	<?php include('../Views/Shared/Header.php'); ?>
	<?php include('../Views/Shared/Notifications.php'); ?>
	<div class="col-lg-8 col-lg-offset-1">
		<main id="main">
			<?php include_once($view); ?>
		</main>
	</div>
	<div class="col-lg-2">
		<aside>
			<?php Html::renderAction('cart', 'show') ?>
		</aside>
		<aside>
			<h4>Categories</h4>
			<?php Html::renderAction('categories', 'all') ?>
		</aside>
	</div>
	<?php include('../Views/Shared/Footer.php'); ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src='<?php echo APP_ROOT_URL ?>Core/Scripts/AjaxFormHelper.js'></script>
	<script type="text/javascript" src='<?php echo APP_ROOT_URL ?>Core/Scripts/Pager.js'></script>
</div>
</body>
</html>
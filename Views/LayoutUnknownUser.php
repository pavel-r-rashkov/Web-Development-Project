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
	<row>
		<?php include('../Views/Shared/HeaderUnknownUser.php'); ?>
	</row>
	<row>
		<?php include('../Views/Shared/Notifications.php'); ?>
		<div class="row">
			<main class="col-lg-6 col-lg-offset-3">
				<?php include_once($view); ?>
			</main>
		</div>
	</row>
	<row>
		<?php include('../Views/Shared/Footer.php'); ?>
	</row>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src='<?php echo APP_ROOT_URL ?>Core/Scripts/AjaxFormHelper.js'></script>
</div>
</body>
</html>
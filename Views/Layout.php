<?php include('../Views/Shared/Header.php'); ?>
<div>======================================</div>
<?php include('../Views/Shared/Notifications.php'); ?>
<main>
	<?php include_once($view); ?>
</main>
<div>======================================</div>	
<?php include('../Views/Shared/Footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src='<?php echo APP_ROOT_URL ?>Core/Scripts/AjaxFormHelper.js'></script>
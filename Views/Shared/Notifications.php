<section>
	<?php if (isset($_SESSION['info'])) { ?> 
		<div class="alert alert-info" role="alert">
		<?php echo $_SESSION['info']; ?>
		</div>
	<?php } 
	if (isset($_SESSION['warrning'])) { ?>
		<div class="alert alert-warning" role="alert">
		<?php echo $_SESSION['warrning']; ?>
		</div>
	<?php } 
	if (isset($_SESSION['success'])) { ?>
		<div class="alert alert-success" role="alert">
		<?php echo $_SESSION['success']; ?>
		</div>
	<?php } ?> 
</section>
<?php 
unset($_SESSION['info']);
unset($_SESSION['warrning']);
unset($_SESSION['success']);
?>
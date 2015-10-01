<section>
	<div class="info">
	<?php
	if (isset($_SESSION['info'])) { 
		echo $_SESSION['info']; 
	}
	?>
	</div>
	<div class="warrning">
	<?php 
	if (isset($_SESSION['warrning'])) { 
		echo $_SESSION['warrning']; 
	} 
	?>
	</div>
</section>
<?php 
unset($_SESSION['info']);
unset($_SESSION['warrning']);
?>
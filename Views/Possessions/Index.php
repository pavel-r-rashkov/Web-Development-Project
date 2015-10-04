<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<section>
	<h4>Possessions: </h4>
	<div id="possessions-page">
		<?php foreach ($model as $possession) { ?>
			<div class="col-lg-4 possession">
				<div><?php echo Html::link('products/show/' . $possession->getProductId(), $possession->getProductName()); ?></div>
				<div>Quantity: <?php ViewEngine::show($possession->getQuantity()); ?></div>
			</div>
		<?php } ?>
	</div>
</section>
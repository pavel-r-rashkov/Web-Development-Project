<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<section>
	<h4>Sells: </h4>
	<div id="sells-page">
		<?php foreach ($model as $sell) { ?>
			<div class="col-lg-6 sell">
					<div class="pull-left">
						<div><?php echo Html::link('products/show/' . $sell->getProduct()->getId(), $sell->getProduct()->getName()); ?></div>
						<div><?php ViewEngine::show($sell->getProduct()->getCategoryName()); ?></div>
						<?php if ($sell->getQuantity() > 0) { ?>
						<div>Quantity: <?php ViewEngine::show($sell->getQuantity()); ?></div>
						<?php } else { ?>
						<div>Not available</div>
						<?php } ?>
					</div>
					<div class="pull-right">
						<?php if ($sell->getDiscount() > 0) { ?>
						<div class="discounted">
						<?php } else { ?>
						<div>
						<?php } ViewEngine::show($sell->getPrice()); ?>$
						</div>
						<?php if ($sell->getDiscount() > 0) { ?>
						<div><?php ViewEngine::show($sell->getPrice() * (1 - $sell->getDiscount())); ?>$</div>
						<div class="label label-success"><?php ViewEngine::show($sell->getDiscount() * 100 . '%'); ?></div>
						<?php } ?>
					</div>
					<div class="clearfix"></div>
					<div class="pull-right">
					<?php if ($sell->getQuantity() > 0) { ?>
						<div>
						<?php echo Html::form('post', 'cart/add/' . $sell->getId());
						echo Html::number('pull-left sell-count', 'count', 1);
						echo Html::submit('btn btn-info pull-right', 'Add to cart');
						echo Html::csrfToken();
						echo Html::formClose(); ?>
						</div>
					<?php } ?>
					</div>
			</div>
		<?php } ?>
	</div>
</section>
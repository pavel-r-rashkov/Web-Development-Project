<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<section>
	<h4>Your cart</h4>
	<div id="cart">
		<?php foreach ($model->getSells() as $sell) { ?>
			<div class="sell">
				<div><?php ViewEngine::show($sell->getProduct()->getName()); ?></div>
				<div>
					Price: <?php ViewEngine::show($sell->getPrice() * (1 - $sell->getDiscount()) * $_SESSION['cart'][$sell->getId()]);?>$
				</div>
				<div>Quantity: <?php ViewEngine::show($_SESSION['cart'][$sell->getId()]); ?></div>
			</div>
		<?php } ?>
		<div class="discounted centered"><?php ViewEngine::show($model->getTotal()); ?></div>
		<div class="centered">Total: <?php ViewEngine::show($model->getTotalFinal()); ?></div>
		<?php if (count($model) > 0) { ?>
		<div>
			<?php echo Html::form('post', 'cart/checkout');
				echo Html::submit('btn btn-success cart-btn', 'Buy');
				echo Html::csrfToken();
				echo Html::formClose(); ?>
		</div>
		<div>
			<?php echo Html::link('cart/clear', 'Clear cart', 'btn btn-warning cart-btn') ?>
		</div>
		<?php } ?>
	</div>
</section>
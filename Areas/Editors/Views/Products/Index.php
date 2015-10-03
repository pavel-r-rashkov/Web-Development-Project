<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<section>
	<h4>Products: </h4>
	<?php echo Html::link('editors/products/newproduct', 'Add product', 'btn btn-info ') ?>
	<div id="products-page">
		<?php Html::renderAction('products', 'paged', array('page' => $model), 'editors') ?>
	</div>
</section>
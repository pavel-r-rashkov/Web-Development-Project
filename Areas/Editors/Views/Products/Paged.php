<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<table class="table">
	<tr>
		<th>Name</th>
		<th>Quantity</th>
		<th>Category</th>
	</tr>
	<?php foreach($model->getProducts() as $product) { ?>
		<tr>
			<td><?php ViewEngine::show($product->getName()) ?></td>
			<td><?php ViewEngine::show($product->getQuantity()) ?></td>
			<td><?php #ViewEngine::show($product->getCategory()->getName()) ?></td>
			<td><?php echo Html::link('editors/products/edit/' . $product->getId(), 'Edit product', 'btn btn-warning') ?></td>
			<td>
				<?php echo Html::form('post', 'editors/products/delete/' . $product->getId());
				echo Html::submit('btn btn-danger', 'Delete product', 'btn btn-danger');
				echo Html::csrfToken();
				echo Html::formClose(); ?>
			</td>
		</tr>
	<?php } ?>
</table>
<?php echo Html::pager('products-page', 'editors/products/paged', $model->getPageSize(), $model->getCount(), $model->getPage()) ?>
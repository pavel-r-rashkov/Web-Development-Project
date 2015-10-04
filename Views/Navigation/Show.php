<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><?php echo Html::link('sells/index', 'Sells') ?></li>
				<li><?php echo Html::link('possessions/index/' . $model->getId(), 'My possessions') ?></li>
				<li><?php echo Html::link('promotions/newpromotion', 'Create promotion') ?></li>
				<li><?php echo Html::link('sells/newsell', 'Create sell') ?></li>
				<?php if ($model->getIsEditor() || $model->getIsAdmin()) { ?> 
					<li><?php echo Html::link('editors/products/index', 'Products') ?></li>
				<?php } ?>
				<?php if ($model->getIsEditor() || $model->getIsAdmin()) { ?> 
					<li><?php echo Html::link('editors/sells/newsell', 'Create Shop sell') ?></li>
				<?php } ?>
				<?php if ($model->getIsEditor() || $model->getIsAdmin()) { ?> 
					<li><?php echo Html::link('editors/categories/newcategory', 'Create category') ?></li>
				<?php } ?>
				<?php if ($model->getIsAdmin()) { ?> 
					<li><?php echo Html::link('administrators/usercriterias/newcriteria', 'Create user criteria') ?></li>
				<?php } ?>
				<?php if ($model->getIsAdmin()) { ?> 
					<li><?php echo Html::link('administrators/users/index', 'Users') ?></li>
				<?php } ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><?php echo Html::link('home/index', $model->getUsername()) ?></li>
				<li><?php echo Html::link('sessions/destroy', 'Log out') ?></li>
			</ul>
		</div>
	</div>
</nav>
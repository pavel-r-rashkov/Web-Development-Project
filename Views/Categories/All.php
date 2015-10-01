<?php 
use Core\ResultExecution\ViewEngine;
foreach ($model as $category) { 
?>
	<div><?php ViewEngine::show($category->getName()); ?></div>
<?php } ?>
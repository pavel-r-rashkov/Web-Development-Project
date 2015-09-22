<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
//ViewEngine::modelType($model, '');
?>

<div>================</div>
<?php echo Html::radio('gender', 'male') ?>
<?php echo Html::radio('gender', 'female', true) ?>
<div>Content -</div>
<?php echo Html::checkbox('hungry', 'yes') ?>
<?php echo Html::checkbox('hungry', 'no', true) ?>
</br>
<?php echo Html::inputField('name', '', 'placeholder') ?>
<?php echo Html::inputField('name', 'my name') ?>
</br>
<?php echo Html::textarea('myText', '', 'some text...') ?>
<?php echo Html::textarea('myText', '', 'some text...', 5, 10) ?>
</br>
<?php echo Html::password('pass', 'my pass') ?>
<?php echo Html::password('pass', '', 'enter your pass...') ?>
</br>
<?php echo Html::select('category', 
	array('3' => 'Cat 1', '4' => 'Cat dd')) ?>
<div>================</div>
<?php echo Html::renderRoute('test/test/5') ?>
<div>================</div>
<?php
use Core\ResultExecution\ViewEngine;
use Core\HtmlHelpers\Html;
?>

<table class="table">
	<tr>
		<th>Id</th>
		<th>Username</th>
		<th>Money</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach($model->getUsers() as $user) { ?>
		<tr>
			<td><?php ViewEngine::show($user->getId()) ?></td>
			<td><?php ViewEngine::show($user->getUsername()) ?></td>
			<td><?php ViewEngine::show($user->getMoney()) ?></td>
			<td>
			<?php 
			if ($user->getBanned() == 0) {
				echo Html::form('post', 'administrators/users/ban/' . $user->getId());
				echo Html::submit('btn btn-danger', 'Ban');
				echo Html::csrfToken();
				echo Html::formClose(); 
			} else {
				echo Html::form('post', 'administrators/users/unban/' . $user->getId());
				echo Html::submit('btn btn-success', 'Unban');
				echo Html::csrfToken();
				echo Html::formClose(); 	
			}
			?>
			</td>
			<td><?php echo Html::link('possessions/index/' . $user->getId(), 'Show possessions', 'btn btn-info') ?></td>
		</tr>
	<?php } ?>
</table>
<?php echo Html::pager('users-page', 'administrators/users/paged', $model->getPageSize(), $model->getCount(), $model->getPage()) ?>
<?php

namespace Areas\Administrators\Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Comment;

class CommentsController extends AdminController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function delete($commentId, $sellId) {
		$this->shopData->getCommentRepository()->deleteComment($commentId);
		return new RedirectActionResult('sells/show/' . $sellId);
	}
}
?>
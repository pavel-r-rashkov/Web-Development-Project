<?php

namespace Areas\Administrators\Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Comment;

/**
*@AuthorizeRole(Admin)
*/
class CommentsController extends AdminController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function delete($id, $productId) {
		$this->shopData->getCommentRepository()->deleteComment($id);
		$_SESSION['info'] = 'Comment deleted';
		return new RedirectActionResult('products/show/' . $productId);
	}
}
?>
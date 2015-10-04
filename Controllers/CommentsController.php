<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Comment;
use BindingModels\Comments\CreateCommentBindingModel;

/**
*@AuthenticateUser()
*/
class CommentsController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function newComment($productId) {
		$comment = new CreateCommentBindingModel();
		$comment->setProductId($productId);

		return new PartialViewResult($comment, 'Comments/NewComment.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateCommentBindingModel $newComment) {
		if ($newComment == null || !$newComment->isValid()) {
			$_SESSION['warrning'] = 'Invalid comment data';
			return new RedirectActionResult('products/show/' . $newComment->getProductId());
		}

		$comment = new Comment(
			$newComment->getContent(),
			date("Y-m-d"),
			$this->currentUser(),
			$newComment->getProductId());
		$this->shopData->getCommentRepository()->addComment($comment);

		$_SESSION['success'] = 'Comment created';
		return new RedirectActionResult('products/show/' . $newComment->getProductId());
	}
}
?>
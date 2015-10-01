<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Comment;
use BindingModels\Comments\CreateCommentBindingModel;

class CommentsController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function newComment($productId, $sellId) {
		$comment = new CreateCommentBindingModel();
		$comment->setProductId($productId);
		$comment->setSellId($sellId);

		return new PartialViewResult($comment, 'Comments/NewComment.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateCommentBindingModel $newComment) {
		if ($newComment == null || !$newComment->isValid()) {
			return new RedirectActionResult('sells/show/' . $newComment->getSellId());
		}

		$comment = new Comment($newCategory->getName());
		$this->shopData->getCommentRepository()->addComment($category);

		return new RedirectActionResult('sells/show/' . $newComment->getSellId());
	}
}
?>
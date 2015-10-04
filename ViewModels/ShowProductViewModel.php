<?php 

namespace ViewModels;

class ShowProductViewModel {
	private $product;
	private $comments;
	private $canDeleteComment;

	public function __construct($product, $comments, $canDelete) {
		$this->product = $product;
		$this->comments = $comments;
		$this->canDeleteComment = $canDelete;
	}

	public function getProduct() {
		return $this->product;
	}

	public function getComments() {
		return $this->comments;
	}

	public function getCanDeleteComment() {
		return $this->canDeleteComment;
	}
}

?>
<?php

namespace BindingModels\Comments;

class CreateCommentBindingModel {
	private $content;
	private $productId;
	private $sellId;

	public function getContent() {
		return $this->content;
	}

	public function setContent($value) {
		$this->content = $value;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setProductId($value) {
		$this->productId = $value;
	}

	public function getSellId() {
		return $this->sellId;
	}

	public function setSellId($value) {
		$this->sellId = $value;
	}

	public function isValid() {
		return $this->content != null && strlen($this->content) <= 150;
	}
}

?>
<?php

namespace Models;

class Comment {
	private $id;
	private $content;
	private $commentDate;
	private $userId;
	private $productId;

	public function __construct($content, $commentDate, $userId, $productId, $id = null) {
		$this->setId($id);
		$this->setContent($content);
		$this->setCommentDate($commendDate);
		$this->setUserId($userId);
		$this->setProductId($productId);
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($value) {
		if ($value == null || strlen($value) < 20) {
			throw new \Exception('Review must be at least 20 letters long');
		}
		$this->content = $value;
	}

	public function getCommentDate() {
		return $this->commendDate;
	}

	public function setCommentDate($value) {
		$this->commentDate = $value;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($value) {
		$this->userId = $value;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setProductId($value) {
		$this->productId = $value;
	}
}

?>
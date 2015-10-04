<?php

namespace Models;

class Comment {
	private $id;
	private $content;
	private $commentDate;
	private $userId;
	private $productId;
	private $username;

	public function __construct($content, $commentDate, $userId, $productId, $id = null, $username = null) {
		$this->setId($id);
		$this->setContent($content);
		$this->setCommentDate($commentDate);
		$this->setUserId($userId);
		$this->setProductId($productId);
		$this->setUsername($username);
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
		$this->content = $value;
	}

	public function getCommentDate() {
		return $this->commentDate;
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

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($value) {
		$this->username = $value;
	}
}

?>
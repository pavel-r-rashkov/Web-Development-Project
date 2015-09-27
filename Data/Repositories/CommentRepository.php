<?php

namespace Data\Repositories;
use Models\Comment;

class CommentRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function addComment(Comment $comment) {

	}

	public function deleteComment($id) {

	}

	public function getProductComments($productId) {

	}
}

?>
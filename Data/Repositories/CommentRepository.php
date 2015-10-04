<?php

namespace Data\Repositories;
use Models\Comment;

class CommentRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function addComment(Comment $comment) {
		$result = $this->db->prepare("
			INSERT INTO comment(comment_date, content, user_id, product_id)
			VALUES(?, ?, ?, ?)
		");

		$result->execute([ $comment->getCommentDate(), $comment->getContent(), $comment->getUserId(), $comment->getProductId() ]);
	}

	public function deleteComment($id) {
		$result = $this->db->prepare("
			DELETE c FROM comment c
			WHERE id = ?
		");

		$result->execute([ $id ]);
	}

	public function getProductComments($productId) {
		$result = $this->db->prepare("
			SELECT c.id, c.comment_date, c.content, c.user_id, c.product_id, u.username
			FROM comment c
			JOIN user u
				ON c.user_id = u.id
			WHERE c.product_id = ?
		");
		$result->execute([ $productId ]);
		$data = $result->fetchAll();
		$comments = array();
		foreach ($data as $row) {
			array_push($comments, new Comment(
				$row['content'], 
				$row['comment_date'],
				$row['user_id'],
				$row['product_id'],
				$row['id'],
				$row['username']));
		}

		return $comments;
	}
}

?>
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

		$result->execute([ $comment->getCommentDate(), $comment->getContent(), $comment->getUserId(), $comment->productId() ]);
	}

	public function deleteComment($id) {
		$result = $this->db->prepare("
			DELETE c FROM comment c
			WHERE id = ?
		");

		$result->execute([ $id ]);
	}

	// public function getProductComments($productId) {
	// 	$result = $this->db->prepare("
	// 		SELECT id, comment_date, content, user_id, product_id
	// 		FROM comment
	// 		WHERE product_id = ?
	// 	");
	// 	$result->execute([ $productId ]);
	// 	$comments = array();
	// 	foreach ($result as $row) {
	// 		array_push($categories, new Category($row['name'], $row['id']));
	// 	}

	// 	return $categories;
	// }
}

?>
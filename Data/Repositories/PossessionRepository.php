<?php

namespace Data\Repositories;
use Models\Possession;

class PossessionRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function find($possessionId) {
		$result = $this->db->prepare("
			SELECT id, product_id, owner_id, quantity
			FROM possession
			WHERE id = ?
		");

		$result->execute([ $possessionId ]);
		$data = $result->fetch();
		$possession = new Possession( 
			$data['product_id'], 
			$data['owner_id'], 
			$data['quantity'], 
			$data['id']);

		return $possession;
	}

	public function getPossessionByProductId($productId, $userId) {
		$result = $this->db->prepare("
			SELECT id, product_id, owner_id, quantity
			FROM possession
			WHERE product_id = ? AND owner_id = ?
		");

		$result->execute([ $productId, $userId ]);
		$data = $result->fetch();
		if(!$data) {
			return null;
		}
		$possession = new Possession( 
			$data['product_id'], 
			$data['owner_id'], 
			$data['quantity'], 
			$data['id']);

		return $possession;
	}

	public function addPossession(Possession $possession) {
		$result = $this->db->prepare("
			INSERT INTO possession(product_id, owner_id, quantity)
			VALUES(?, ?, ?)
		");

		$result->execute([ $possession->getProductId(), $possession->getOwnerId(), $possession->getQuantity() ]);
	}

	public function updatePossession(Possession $possession) {
		$result = $this->db->prepare("
			UPDATE possession
			SET product_id = ?,
				owner_id = ?,
				quantity = ?
			WHERE id = ?
		");

		$result->execute([ $possession->getProductId(), $possession->getOwnerId(), $possession->getQuantity(), $possession->getId() ]);
	}

	public function getPossessions($id) {
		$result = $this->db->prepare("
			SELECT pos.id AS possession_id, p.name, p.category_id, p.id AS product_id, pos.quantity 
			FROM possession pos
			JOIN product p
				ON p.id = pos.product_id
			WHERE owner_id = ?
		");

		$result->execute([ $id ]);
		$data = $result->fetchAll();
		$possessions = array();
		foreach ($data as $row) {
			array_push($possessions, new Possession(
				$row['product_id'],
				$id, 
				$row['quantity'], 
				$row['possession_id'], 
				$row['name']));
		}

		return $possessions;
	}

	public function deletePossession($id) {
		$result = $this->db->prepare("
			DELETE p FROM possession p
			WHERE id = ?
		");

		$result->execute([ $id ]);
	}
}

?>
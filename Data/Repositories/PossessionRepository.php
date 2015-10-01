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
		$possession = new Possession( 
			$result[0]['product_id'], 
			$result[0]['owner_id'], 
			$result[0]['quantity'], 
			$result[0]['id']);

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

	public function deletePossession($id) {
		$result = $this->db->prepare("
			DELETE p FROM possession p
			WHERE id = ?
		");

		$result->execute([ $id ]);
	}
}

?>
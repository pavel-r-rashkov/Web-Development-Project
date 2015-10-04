<?php

namespace Data\Repositories;
use Models\Sell;
use Models\Product;

class SellRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function addSell(Sell $sell) {
		$result = $this->db->prepare("
			INSERT INTO sell(owner_id, product_id, quantity, price)
			VALUES(?, ?, ?, ?)
		");

		$result->execute([ 
			$sell->getOwnerId(), 
			$sell->getProductId(), 
			$sell->getQuantity(),
			$sell->getPrice() 
		]);
	}

	public function getSellsByIds($sellIds, $userId) {
		if (count($sellIds) == 0) {
			return array();
		}
		$ids = implode(',', array_fill(0, count($sellIds), '?'));

		$result = $this->db->prepare("
			SELECT p.name AS product_name, s.quantity, c.name AS category_name,
				MAX(prom.discount) AS discount, s.owner_id, p.id AS product_id, s.price,
				s.id AS sell_id, p.quantity AS product_quantity, p.description, c.id AS category_id,
				p.description, c.name AS category_name
			FROM sell s
			JOIN product p
				ON p.id = s.product_id
			LEFT JOIN category c
				ON c.id = p.category_id
			LEFT JOIN promotion prom
				ON ((prom.user_id = s.owner_id) OR (s.owner_id IS NULL AND prom.user_id IS NULL))
				AND ((prom.product_id = s.product_id) OR prom.product_id IS NULL)
				AND ((prom.category_id = c.id) OR (prom.category_id IS NULL))
				AND prom.start_date >= CURDATE() AND prom.end_date <= CURDATE()
			JOIN user u
				ON u.id = ?
			LEFT JOIN user_criteria uc
				ON prom.user_criteria_id = uc.id 
				AND (uc.min_cash IS NULL OR uc.min_cash <= u.money)
				AND (uc.min_days_registered IS NULL OR uc.min_days_registered <= DATEDIFF(CURDATE(), u.register_date))
			GROUP BY s.id, c.name, s.owner_id, p.id, s.price, s.id, p.quantity, p.description, c.id
			HAVING s.id IN (" . $ids . ")
		");
		
		array_unshift($sellIds, $userId);
		$result->execute($sellIds);

		$data = $result->fetchAll();

		$sells = array();
		foreach ($data as $row) {
			array_push($sells, new Sell(
				$row['owner_id'],
				$row['product_id'], 
				$row['quantity'], 
				$row['price'], 
				$row['sell_id'],
				new Product($row['product_name'], $row['product_quantity'],
					$row['description'], $row['category_id'], $row['category_name']),
				$row['discount']));
		}

		return $sells;
	}

	public function getSells($userId) {
		$result = $this->db->prepare("
			SELECT p.name AS product_name, 
				s.quantity, 
				c.name AS category_name,
				MAX(prom.discount) AS discount, 
				s.owner_id, 
				p.id AS product_id, 
				s.price,
				s.id AS sell_id, 
				p.quantity AS product_quantity, 
				p.description, 
				c.id AS category_id
			FROM sell s
			JOIN product p
				ON p.id = s.product_id
			JOIN category c
				ON c.id = p.category_id
			LEFT JOIN promotion prom
				ON ((prom.user_id = s.owner_id) OR (s.owner_id IS NULL AND prom.user_id IS NULL))
				AND ((prom.product_id = s.product_id) OR prom.product_id IS NULL)
				AND ((prom.category_id = c.id) OR (prom.category_id IS NULL))
				AND prom.start_date >= CURDATE() AND prom.end_date <= CURDATE()
			JOIN user u
				ON u.id = ?
			LEFT JOIN user_criteria uc
				ON prom.user_criteria_id = uc.id 
				AND (uc.min_cash IS NULL OR uc.min_cash <= u.money)
				AND (uc.min_days_registered IS NULL OR uc.min_days_registered <= DATEDIFF(CURDATE(), u.register_date))
			GROUP BY s.id, c.name, s.owner_id, p.id, s.price, s.id, p.quantity, p.description, c.id
		");

		$result->execute([ $userId ]);
		$data = $result->fetchAll();

		$sells = array();
		foreach ($data as $row) {
			array_push($sells, new Sell(
				$row['owner_id'],
				$row['product_id'], 
				$row['quantity'], 
				$row['price'], 
				$row['sell_id'],
				new Product($row['product_name'], $row['product_quantity'],
					$row['description'], $row['category_id'], $row['product_id'], $row['category_name']),
				$row['discount']));
		}

		return $sells;
	}

	public function deleteSells($sellIds) {

	}

	public function updateSell(Sell $sell) {
		$result = $this->db->prepare("
			UPDATE sell
			SET quantity = ?
			WHERE id = ?
		");

		$result->execute([ 
			$sell->getQuantity(),
			$sell->getId()
		]);
	}
}

?>
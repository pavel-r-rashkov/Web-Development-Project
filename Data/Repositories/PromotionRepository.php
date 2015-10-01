<?php

namespace Data\Repository;
use Models\Promotion;

class PromotionRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function addPromotion(Promotion $promotion) {
		$result = $this->db->prepare("
			INSERT INTO promotion(name, start_date, end_date, discount, user_criteria_id, user_id, product_id, category_id)
			VALUES(?, ?, ?, ?, ?, ?, ?, ?)
		");

		$result->execute([ 
			$promotion->getName(), 
			$promotion->getStartDate(), 
			$promotion->getEndDate(),
			$promotion->getDiscount(),
			$promotion->getUserCriteriaId(), 
			$promotion->getUserId(), 
			$promotion->getProductId(),
			$promotion->getCategoryId()
		]);
	}

	// public function getSellPromotions($sellId) {

	// }
}

?>
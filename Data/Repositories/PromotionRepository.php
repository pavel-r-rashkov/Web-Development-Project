<?php

namespace Data\Repository;
use Models\Promotion;

class PromotionRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function addPromotion(Promotion $promotion) {

	}

	public function getSellPromotions($sellId) {

	}
}

?>
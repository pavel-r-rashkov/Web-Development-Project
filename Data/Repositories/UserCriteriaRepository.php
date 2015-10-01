<?php

namespace Data\Repositories;
use Models\UserCriteria;

class UserCriteriaRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function getUserCriterias() {
		$result = $this->db->query("
			SELECT id, name, min_days_registered, min_cash
			FROM user_criteria
		");

		$criterias = array();
		foreach ($result as $row) {
			array_push($criterias, new UserCriteria(
				$row['name'],
				$row['min_days_registered'],
				$row['min_cash'],
				$row['id']));
		}

		return $criterias;
	}

	public function addUserCriteria(UserCriteria $userCriteria) {
		$result = $this->db->prepare("
			INSERT INTO user_criteria(name, min_days_registered, min_cash)
			VALUES(?, ?, ?)
		");

		$result->execute([ 
			$userCriteria->getName(), 
			$userCriteria->getMinimumDaysRegistered(), 
			$userCriteria->getMinimumCash()
		]);
	}
}

?>
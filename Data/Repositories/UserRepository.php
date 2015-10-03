<?php

namespace Data\Repositories;
use Models\User;

class UserRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function findUser($userId) {
		$result = $this->db->prepare("
			SELECT id, username, password_digest, money
			FROM user
			WHERE id = ?
		");

		$result->execute([ $userId ]);
		$user = new User( 
			$result[0]['username'], 
			$result[0]['password_digest'], 
			$result[0]['money'], 
			$result[0]['id']);

		return $user;
	}

	public function addMoney($userId, $amount) {
		$result = $this->db->prepare("
			UPDATE user
			SET money = money + ?,
			WHERE id = ?
		");

		$result->execute([ $amount, $userId ]);
	}

	public function takeMoney($userId, $amount) {
		$result = $this->db->prepare("
			UPDATE user
			SET money = money - ?,
			WHERE id = ?
		");

		$result->execute([ $amount, $userId ]);
	}

	public function getUser($username) {
		$result = $this->db->prepare("
			SELECT id, username, password_digest, money
			FROM user
			WHERE username = ?
		");
		$result->execute([ $username ]);
		$data = $result->fetch();

		if (!$data) {
			return null;
		}
		return new User($data['username'], $data['password_digest'], $data['money'], $data['id']);
	}

	public function addUser(User $user) {
		$result = $this->db->prepare("
			INSERT INTO user(username, password_digest, money)
			VALUES(?, ?, ?);
		");

		$result->execute([ $user->getUsername(), $user->getPasswordDigest(), $user->getMoney() ]);
	}
}

?>
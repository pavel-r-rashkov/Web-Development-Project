<?php

namespace Data\Repositories;
use Models\User;

class UserRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function findUser($userId) {

	}

	public function addMoney($userId, $amount) {

	}

	public function takeMoney($userId, $amount) {

	}

	public function getUser($username) {
		$result = $this->db->prepare("
			SELECT id, username, password_digest
			FROM user
			WHERE username = ?
		");
		$result->execute([ $username ]);
		$data = $result->fetch();

		if (!$data) {
			return null;
		}
		return new User($data['username'], $data['password_digest'], $data['id']);
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
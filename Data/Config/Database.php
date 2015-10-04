<?php

namespace Data\Config;
use Data\Config\Drivers\DriverFactory;

class Database {
	private static $instances;
	private $db;

	private function __construct($db) {
		$this->db = $db;
	}

	public static function getInstance($instanceName = 'default') {
		if (!isset(self::$instances[$instanceName])) {
			throw new \Exception('Instance with that name is not set');
		}

		return self::$instances[$instanceName];
	}

	public static function setInstance(
		$instanceName,
		$driver,
		$user,
		$pass,
		$dbName,
		$host = null
	) {
		$driver = DriverFactory::createDriver($driver, $user, $pass, $dbName, $host);

		$pdo = new \PDO($driver->getDsn(), $user, $pass);
		$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		self::$instances[$instanceName] = new self($pdo);
	}

	public function prepare($statement, array $driverOptions = array()) {
		$statement = $this->db->prepare($statement, $driverOptions);
		return new Statement($statement);
	}

	public function query($query) {
		return $this->db->query($query);
	}

	public function lastId($name = null) {
		return $this->db->lastInsertedId($name);
	}

	public function beginTran() {
		return $this->db->beginTransaction();
	}

	public function commitTran() {
		return $this->db->commit();
	}

	public function rollBack() {
		return $this->db->rollBack();
	}
}

?>
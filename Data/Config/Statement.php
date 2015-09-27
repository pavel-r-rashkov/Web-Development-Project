<?php

namespace Data\Config;

class Statement {
	private $statement;

	public function __construct($pdoStatementInstance) {
		$this->statement = $pdoStatementInstance;
	}

	public function fetch($fetchStyle = \PDO::FETCH_ASSOC) {
		return $this->statement->fetch($fetchStyle);
	}

	public function fetchAll($fetchStyle = \PDO::FETCH_ASSOC) {
		return $this->statement->fetchAll($fetchStyle);
	}

	public function bindParam($parameter, &$variable, $dataType = \PDO::PARAM_STR, $length, $driverOptions) {
		return $this->statement->bindParam($parameter, $variable, $dataType, $length, $driverOptions);
	}

	public function execute(array $inputParams = array()) {
		$this->statement->execute($inputParams);
	}
}

?>
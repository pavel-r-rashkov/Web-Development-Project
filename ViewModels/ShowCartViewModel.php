<?php

namespace ViewModels;

class ShowCartViewModel {
	private $sells;
	private $total;
	private $totalFinal;

	public function __construct($sells, $total, $totalFinal) {
		$this->sells = $sells;
		$this->total = $total;
		$this->totalFinal = $totalFinal;
	}

	public function getSells() {
		return $this->sells;
	}

	public function getTotal() {
		return $this->total;
	}

	public function getTotalFinal() {
		return $this->totalFinal;
	}
}

?>
<?php

namespace Core\Contracts;

interface IViewEngine {
	public function renderViewResult($viewResult, $areaName);
}

?>
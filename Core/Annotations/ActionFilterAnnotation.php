<?php

namespace Core\Annotations;

abstract class ActionFilterAnnotation extends BaseAnnotation {
	public abstract function filterAction();
}

?>
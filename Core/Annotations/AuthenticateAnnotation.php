<?php

namespace Core\Annotations;

abstract class AuthenticateAnnotation extends BaseAnnotation {
	public abstract function authenticate();
}

?>
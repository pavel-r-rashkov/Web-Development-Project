<?php

namespace Core\Annotations;

abstract class AuthorizeAnnotation extends BaseAnnotation {
	public abstract function authorize();
}

?>
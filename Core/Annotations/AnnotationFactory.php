<?php

namespace Core\Annotations;

class AnnotationFactory {
	const ANNOTATION_SUFIX = 'Annotation';

	public function createAnnotation($name, $params) {
		$class = 'Core\\Annotations\\' . $name . self::ANNOTATION_SUFIX;
		$reflection = new \ReflectionClass($class);
		$instance = $reflection->newInstanceArgs($params);
		return $instance;
	}
}

?>
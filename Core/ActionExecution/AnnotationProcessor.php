<?php

namespace Core\ActionExecution;

class AnnotationProcessor {
	public function processAnnotations($annotations) {
		$this->processAuthenticationAnnotations($annotations);
		$this->processAuthorizeAnnotations($annotations);
		$this->processActionFilterAnnotations($annotations);
	}

	private function processAuthenticationAnnotations($annotations) {
		foreach ($annotations as $annotation) {
			if (is_subclass_of($annotation, 'Core\Annotations\AuthenticateAnnotation')) {
				$annotation->authenticate();
			}
		}
	}

	private function processAuthorizeAnnotations($annotations) {
		foreach ($annotations as $annotation) {
			if (is_subclass_of($annotation, 'Core\Annotations\AuthorizeAnnotation')) {
				$annotation->authorize();
			}
		}
	}

	private function processActionFilterAnnotations($annotations) {
		foreach ($annotations as $annotation) {
			if (is_subclass_of($annotation, 'Core\Annotations\ActionFilterAnnotation')) {
				$annotation->filterAction();
			}
		}
	}
}

?>
<?php

class AnnotationHelper {
	const EXTRACT_ANNOTATIONS_PATTERN = '/@([^\(]+?)\(([^)]*?)\)/i';
	const ANNOTATION_PARAM_DELIMITER = ', ';
	private $annotationFactory;

	public function __construct(AnnotationFactory $annotationFactory) {
		$this->annotationFactory = $annotationFactory;
	}

	public function extractAnnotations($classFullName, $methodName) {
		$reflection = new ReflectionClass($classFullName);
		$methodDoc = $reflection->getMethod($methodName)->getDocComment();
		$annotationData = self::getAnnotationsNamesParams($methodDoc);

		$annotations = array();
		foreach ($annotationData as $key => $annotation) {
			$name = $annotation['name'];
			$params = $annotation['params'];
			$annotationInstance = $this->annotationFactory->createAnnotation($name, $params);
			array_push($annotations, $annotationInstance);
		}

		return $annotations;
	}

	private function getAnnotationsNamesParams($objectDoc) {
		preg_match_all(self::EXTRACT_ANNOTATIONS_PATTERN, $objectDoc, $matches);
		$annotationCount = count($matches[1]);
		$annotationsData = array();

		for ($i = 0; $i < $annotationCount; $i++) { 
			$annotationName = $matches[1][$i];
			$annotationParams = $matches[2][$i];
			$params = explode(self::ANNOTATION_PARAM_DELIMITER, $annotationParams);

			$annotation = array();
			$annotation['name'] = $annotationName;
			$annotation['params'] = $params;
			array_push($annotationsData, $annotation);
		}

		return $annotationsData;
	}
}

?>
<?php

namespace Core\HtmlHelpers;

class Tag {
	private $element;
	private $content;
	private $attributes;

	public function __construct($element, $attributes, $content) {
		$this->element = $element;
		$this->content = $content;
		$this->attributes = $attributes;
	}

	public function getHtml() {
		$html = '<' . $this->element . ' ';
		foreach ($this->attributes as $key => $value) {
			$html = $html . $this->createAttribute($key, $value);
		}

		$html = $html . '>';
		if (!is_null($this->content)) {
			$html = $html . $this->content;
		}
		$html = $html . '</' . $this->element . '>';
		return $html;
	}

	private function createAttribute($name, $value) {
		return $name . '="' . $value . '"';
	}
}

?>
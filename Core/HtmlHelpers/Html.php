<?php

namespace Core\HtmlHelpers;
use Core\Utils;

class Html {
	public static function radio($name, $value, $checked = false) {
		$attributes = array(
				'name' => $name, 
				'value' => $value,
				'type' => 'radio');

		if ($checked) {
			$attributes['checked'] = '';
		}

		$tag = new Tag(
			'input',
			$attributes, 
			null);
		return $tag->getHtml();
	}

	public static function checkbox($name, $value, $checked = false) {
		$attributes = array(
				'name' => $name, 
				'value' => $value,
				'type' => 'checkbox');

		if ($checked) {
			$attributes['checked'] = '';
		}

		$tag = new Tag(
			'input',
			$attributes, 
			null);
		return $tag->getHtml();
	}

	public static function inputField($name, $value, $placeholder = '') {
		$attributes = array(
				'name' => $name, 
				'value' => $value,
				'type' => 'text',
				'placeholder' => $placeholder);

		$tag = new Tag(
			'input',
			$attributes, 
			null);
		return $tag->getHtml();
	}

	public static function textarea($name, $content = null, $placeholder = '', $rows = 4, $cols = 50) {
		$attributes = array(
				'name' => $name, 
				'placeholder' => $placeholder,
				'rows' => $rows,
				'cows' => $cols);

		$tag = new Tag(
			'textarea',
			$attributes, 
			$content);
		return $tag->getHtml();
	}

	public static function password($name, $value, $placeholder = '') {
		$attributes = array(
				'type' => 'password',
				'name' => $name, 
				'placeholder' => $placeholder,
				'value' => $value);

		$tag = new Tag(
			'input',
			$attributes,
			null);
		return $tag->getHtml();
	}

	public static function submit($value) {
		$attributes = array(
				'type' => 'submit',
				'value' => $value);

		$tag = new Tag(
			'input',
			$attributes,
			null);
		return $tag->getHtml();
	}

	public static function select($name, $options) {
		$attributes = array('name' => $name);
		$optionsHtml = '';

		foreach ($options as $key => $value) {
			$option = new Tag(
				'option', 
				array('value' => $key), 
				$value);

			$optionsHtml = $optionsHtml . $option->getHtml();
		}

		$tag = new Tag(
			'select',
			$attributes,
			$optionsHtml);
		return $tag->getHtml();
	}
	
	public static function renderRoute($route, $data = array()) {
		$url = APP_ROOT_URL . $route;
		//$data = array('key1' => 'value1', 'key2' => 'value2');
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'GET',
		        'content' => http_build_query($data),
		    ),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		return $result;
	}

	public static function ajaxForm($method, $action, $replaceTarget, $content = null) {
		$attributes = array(
				'method' => $method,
				'action' => APP_ROOT_URL . $action,
				'class' => 'data-ajax-form',
				'data-replace-target' => $replaceTarget);

		$tag = new Tag(
			'form',
			$attributes,
			$content);
		return $tag->getHtml();
	}

	public static function form($method, $action, $content = null) {
		$attributes = array(
				'method' => $method,
				'action' => APP_ROOT_URL . $action);

		$tag = new Tag(
			'form',
			$attributes,
			$content);
		return $tag->getHtml();
	}

	public static function link($route, $content) {
		$attributes = array(
				'href' => APP_ROOT_URL . $route);

		$tag = new Tag(
			'a',
			$attributes,
			$content);
		return $tag->getHtml();
	}

	public static function uploadFile($name) {
		$attributes = array(
				'name' => $name, 
				'type' => 'file');

		$tag = new Tag(
			'input',
			$attributes, 
			null);
		return $tag->getHtml();
	}

	public static function csrfToken() {
		$token = Utils::getToken(80);
		setcookie('CSRF-TOKEN', $token, time() + 1800, '/');

		$attributes = array(
				'type' => 'hidden',
				'name' => 'csrfToken',
				'value' => $token);

		$tag = new Tag(
			'input',
			$attributes,
			null);
		return $tag->getHtml();
	}
}

?>
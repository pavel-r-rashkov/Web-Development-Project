<?php

namespace Core\HtmlHelpers;
use Core\Utils;
use Core\RequestPipeline;

class Html {
	public static function radio($name, $value, $checked = false) {
		$attributes = array(
				'name' => $name, 
				'value' => htmlspecialchars($value),
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
				'value' => htmlspecialchars($value),
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

	public static function label($for, $content) {
		$attributes = array(
				'for' => $for);

		$tag = new Tag(
			'label',
			$attributes, 
			$content);
		return $tag->getHtml();
	}

	public static function inputField($class, $name, $value, $placeholder = '') {
		$attributes = array(
				'class' => $class,
				'name' => $name, 
				'value' => htmlspecialchars($value),
				'type' => 'text',
				'placeholder' => $placeholder);

		$tag = new Tag(
			'input',
			$attributes, 
			null);
		return $tag->getHtml();
	}

	public static function hidden($name, $value) {
		$attributes = array(
				'name' => $name, 
				'value' => htmlspecialchars($value),
				'type' => 'hidden');

		$tag = new Tag(
			'input',
			$attributes, 
			null);
		return $tag->getHtml();
	}

	public static function datePicker($name, $class = '') {
		$attributes = array(
				'class' => $class,
				'name' => $name, 
				'type' => 'date');

		$tag = new Tag(
			'input',
			$attributes, 
			null);
		return $tag->getHtml();
	}

	public static function textarea($class, $name, $content = null, $placeholder = '', $rows = 4, $cols = 50) {
		$attributes = array(
				'class' => $class,
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

	public static function password($class, $name, $value, $placeholder = '') {
		$attributes = array(
				'class' => $class,
				'type' => 'password',
				'name' => $name, 
				'placeholder' => $placeholder,
				'value' => htmlspecialchars($value));

		$tag = new Tag(
			'input',
			$attributes,
			null);
		return $tag->getHtml();
	}

	public static function number($class, $name, $value, $step = 1) {
		$attributes = array(
				'step' => $step,
				'class' => $class,
				'type' => 'number',
				'name' => $name, 
				'value' => htmlspecialchars($value));

		$tag = new Tag(
			'input',
			$attributes,
			null);
		return $tag->getHtml();
	}

	public static function submit($class, $value) {
		$attributes = array(
				'class' => $class,
				'type' => 'submit',
				'value' => htmlspecialchars($value));

		$tag = new Tag(
			'input',
			$attributes,
			null);
		return $tag->getHtml();
	}

	public static function select($name, $options, $class, $selected = null) {
		$attributes = array('name' => $name, 'class' => $class);
		$optionsHtml = '';

		foreach ($options as $key => $value) {
			$optionAttributes = array('value' => htmlspecialchars($key));
			if ($selected != null && $key == $selected) {
				$optionAttributes['selected'] = '';
			}

			$option = new Tag(
				'option', 
				$optionAttributes,
				htmlspecialchars($value));

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
		return $tag->getOpenHtml();
	}

	public static function form($method, $action, $content = null) {
		$attributes = array(
				'method' => $method,
				'action' => APP_ROOT_URL . $action);

		$tag = new Tag(
			'form',
			$attributes,
			$content);
		return $tag->getOpenHtml();
	}

	public static function formClose() {
		return '</form>';
	}

	public static function link($route, $content, $class = '') {
		$attributes = array(
				'href' => APP_ROOT_URL . $route,
				'class' => $class);

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
		static $token = null;
		if ($token == null) {
			$token = Utils::getToken(80);
			setcookie('CSRF-TOKEN', $token, time() + 1800, '/');
		}

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

	public static function pager($target, $path, $size, $count, $page) {
		$route = $path . '?page=';
		$html = '';

		if ($page > 0) {
			$first = new Tag('li', array(), self::link($route . '0', '<span aria-hidden="true">&laquo;</span>'));
			$prev = new Tag('li', array(), self::link($route . ($page - 1), '<span aria-hidden="true">&lt;</span>'));
			$prevPage = new Tag('li', array(), self::link($route . ($page - 1), $page));
			$html = $html . $first->getHtml() . $prev->getHtml() . $prevPage->getHtml();
		}

		$current = new Tag('li', array('class' => 'active'), self::link($route . $page, $page + 1));
		$html = $html . $current->getHtml();

		$lastPageNumber = ceil($count / $size) - 1;
		if ($page < $lastPageNumber) {
			$nextPage = new Tag('li', array(), self::link($route . ($page + 1), $page + 2));
			$next = new Tag('li', array(), self::link($route . ($page + 1), '<span aria-hidden="true">&gt;</span>'));
			$last = new Tag('li', array(), self::link($route . $lastPageNumber, '<span aria-hidden="true">&raquo;</span>'));
			$html = $html . $nextPage->getHtml() . $next->getHtml() . $last->getHtml();
		}

		$ul = new Tag('ul', array('class' => 'pagination'), $html);
		$nav = new Tag('nav', array('data-replace-target' => $target, 'data-pager' => ''), $ul->getHtml());
		return $nav->getHtml();
	}

	public static function renderAction($controllerName, $actionName, $params = array(), $areaName = null) {
		RequestPipeline::executeAction($controllerName, $actionName, $params, $areaName);
	}
}

?>
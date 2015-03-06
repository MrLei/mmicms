<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Base;

abstract class FormRenderer extends FormCore {

	/**
	 * Renderer nagłówka formularza
	 * @return string
	 */
	public function start() {
		return '<form id="' . $this->_formBaseName .
			'" action="' . ($this->getOption('action') ? $this->getOption('action') : '#') .
			'" method="' . $this->getOption('method') .
			'" enctype="' . $this->getOption('enctype') .
			'" class="vertical ' . $this->getOption('class') .
			'" accept-charset="' . $this->getOption('accept-charset') .
			'">';
	}

	/**
	 * Renderer stopki formularza
	 * @return string
	 */
	public function end() {
		return '</form>';
	}

	/**
	 * Automatyczny renderer formularza
	 * @return string
	 */
	public function render() {
		$html = $this->start();
		foreach ($this->_elements AS $element) {
			$html .= $element->__toString();
		}
		return $html . $this->end();
	}

	/**
	 * Renderer formularza
	 * Renderuje bezpośrednio, lub z szablonu
	 * @return string
	 */
	public function __toString() {
		try {
			return $this->render();
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

}

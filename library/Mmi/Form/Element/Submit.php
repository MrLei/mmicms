<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element;

class Submit extends ElementAbstract {

	/**
	 * Konstruktor, ustawia nazwę pola i opcje
	 * @param string $name nazwa
	 * @param array $options opcje
	 */
	public function __construct($name, array $options = array()) {
		if (!isset($options['ignore'])) {
			$options['ignore'] = true;
		}
		$this->setRenderingOrder(array('fetchField', 'fetchErrors', 'fetchCustomHtml'));
		parent::__construct($name, $options);
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$html = '<input ';
		if (isset($this->_options['label'])) {
			if ($this->_translatorEnabled) {
				$this->_options['value'] = $this->getTranslate()->_($this->_options['label']);
			} else {
				$this->_options['value'] = $this->_options['label'];
			}
		}
		$html .= 'type="submit" ' . $this->_getHtmlOptions() . '/>';
		return $html;
	}

}

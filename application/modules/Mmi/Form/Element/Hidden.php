<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element;

class Hidden extends ElementAbstract {

	public function init() {
		$this->setRenderingOrder(array('fetchField', 'fetchErrors'));
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		if (isset($this->_options['value'])) {
			$this->_options['value'] = str_replace('"', '&quot;', $this->_options['value']);
		}
		$html = '<input ';
		$html .= 'type="hidden" ' . $this->_getHtmlOptions() . '/>';
		return $html;
	}

}

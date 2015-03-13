<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Element;

class Antirobot extends \Mmi\Form\Element\Hidden {

	/**
	 * Ignorowanie tego pola, pole obowiązkowe, automatyczna walidacja
	 */
	public function init() {
		$this->_options['ignore'] = true;
		$this->_options['required'] = true;
		$this->_options['validators'] = array(
			array(
				'validator' => 'Antirobot',
				'options' => array('name' => $this->_options['name'])
		));
		$view = \Mmi\Controller\Front::getInstance()->getView();
		$view->headScript()->appendScript('$(document).ready('
			. 'function() { $(\'div.antirobot > input\').val(\'js-\' + $(\'div.antirobot > input\').val() + \'-js\'); });');
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$this->_options['value'] = \Mmi\Validate\Antirobot::generateCrc();
		return parent::fetchField();
	}

}

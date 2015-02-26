<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * MmiCms/Form/Element/Antirobot.php
 * @category   MmiCms
 * @package    MmiCms\Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa elementu zabezpieczenia przed robotami
 * @category   MmiCms
 * @package    MmiCms\Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace MmiCms\Form\Element;

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

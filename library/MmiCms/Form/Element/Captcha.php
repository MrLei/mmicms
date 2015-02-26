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
 * MmiCms/Form/Element/Captcha.php
 * @category   MmiCms
 * @package    MmiCms\Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa elementu captcha
 * @category   MmiCms
 * @package    MmiCms\Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace MmiCms\Form\Element;

class Captcha extends \Mmi\Form\Element\ElementAbstract {

	/**
	 * Ignorowanie tego pola, pole obowiązkowe, automatyczna walidacja
	 */
	public function init() {
		$this->_options['ignore'] = true;
		$this->_options['required'] = true;
		$this->_options['validators'] = array(
			array(
				'validator' => 'Captcha',
				'options' => array('name' => $this->_options['name'])
		));
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		if (isset($this->_options['value'])) {
			$this->_options['value'] = str_replace('"', '&quot;', $this->_options['value']);
		}
		$view = \Mmi\Controller\Front::getInstance()->getView();
		$html = '<div class="image"><img src="' . $view->url(array('module' => 'cms', 'controller' => 'captcha', 'action' => 'index', 'name' => $this->_options['name'])) . '" alt="" /></div>';
		$html .= '<div class="input"><input ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/></div>';
		return $html;
	}

}

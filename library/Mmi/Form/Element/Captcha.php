<?php
/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Form/Element/Captcha.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu captcha
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Captcha extends Mmi_Form_Element_Abstract {

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
		$view = Mmi_Controller_Front::getInstance()->getView();
		$html = '<div class="image"><img src="' . $view->url(array('module' => 'cms', 'controller' => 'captcha', 'action' => 'index', 'name' => $this->_options['name'])) . '" alt="" /></div>';
		$html .= '<div class="input"><input ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/></div>';
		return $html;
	}

}
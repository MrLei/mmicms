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
 * Mmi/Form/Element/Hidden.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa ukrytego elementu (hidden)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Hidden extends Mmi_Form_Element_Abstract {

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
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
 * Mmi/Form/Element/Button.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu klawisz (button)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Button extends Mmi_Form_Element_Abstract {

	/**
	 * Ignorowanie tego pola
	 */
	public function init() {
		$this->_options['ignore'] = true;
	}

	public function __toString() {
		$this->preRender();
		$html = $this->fetchBegin();
		$html .= $this->fetchField();
		$html .= $this->fetchErrors();
		$html .= $this->fetchEnd();
		return $html;
	}

	public function fetchField() {
		$html = '<input ';
		if (isset($this->_options['label'])) {
			$this->_options['value'] = $this->_options['label'];
		}
		$html .= 'type="button" ' . $this->_getHtmlOptions() . '/>';
		return $html;
	}

}
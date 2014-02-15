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
 * Mmi/Form/Element/Submit.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu wyślij (submit)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Submit extends Mmi_Form_Element_Abstract {
	
	/**
	 * Konstruktor, ustawia nazwę pola i opcje
	 * @param string $name nazwa
	 * @param array $options opcje
	 */
	public function __construct($name, array $options = array()) {
		if (!isset($options['ignore'])) {
			$options['ignore'] = true;
		}
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

	/**
	 * Zwraca string'ową reprezentację obiektu
	 * @return string
	 */
	public function __toString() {
		$this->preRender();
		$html = $this->fetchBegin();
		$html .= $this->fetchField();
		$html .= $this->fetchErrors();
		$html .= $this->fetchEnd();
		return $html;
	}
	
}
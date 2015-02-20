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
 * Mmi/Form/Element/Text.php
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa elementu tekst (text)
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Form\Element;

class Text extends ElementAbstract {

	public function fetchField() {
		$this->addFilter('Input');
		if (isset($this->_options['value'])) {
			$filter = $this->_getFilter('Input');
			$this->_options['value'] = $filter->filter($this->_options['value']);
		}
		if (isset($this->_options['placeholder']) && $this->_translatorEnabled && ($this->getTranslate() !== null)) {
			$this->_options['placeholder'] = $this->getTranslate()->_($this->_options['placeholder']);
		}
		$html = '<input ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/>';
		return $html;
	}

}
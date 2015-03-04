<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element\Base;

abstract class Element extends ElementRenderer {

	/**
	 * Buduje opcje HTML
	 * @return string
	 */
	protected final function _getHtmlOptions() {
		$options = $this->getOptions();
		if (isset($options['validators']) && !isset($options['noAjax'])) {
			$options['class'] = trim((isset($options['class']) ? $options['class'] . ' validate' : 'validate'));
		}
		unset($options['description']);
		unset($options['filters']);
		unset($options['ignore']);
		unset($options['label']);
		unset($options['labelPostfix']);
		unset($options['labelAsterisk']);
		unset($options['markRequired']);
		unset($options['multiOptions']);
		unset($options['labelClass']);
		unset($options['required']);
		unset($options['requiredAsterisk']);
		unset($options['translatorDisabled']);
		unset($options['validators']);
		unset($options['customHtml']);
		unset($options['count']);
		if (isset($options['disabled']) && is_array($options['disabled']) && empty($options['disabled'])) {
			unset($options['disabled']);
		}
		$html = '';
		foreach ($options as $key => $value) {
			$html .= $key . '="' . str_replace('"', '&quot;', $value) . '" ';
		}
		return $html;
	}

	/**
	 * Dodaje walidator alfanumeryczny
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorAlnum($message = null) {
		return $this->addValidator('alnum', array(), $message);
	}

	/**
	 * Dodaje walidator dat
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorDate($message = null) {
		return $this->addValidator('date', array(), $message);
	}

	/**
	 * Dodaje walidator e-maili
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorEmailAddress($message = null) {
		return $this->addValidator('emailAddress', array(), $message);
	}

	/**
	 * Dodaje walidator równości z wartością
	 * @param mixed $value wartość porównania
	 * @param bool $isCheckbox czy checkbox
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorEqual($value, $isCheckbox = false, $message = null) {
		return $this->addValidator('equal', array('value' => $value, 'checkbox' => (bool) $isCheckbox), $message);
	}

	/**
	 * Dodaje walidator numerów IBAN
	 * @param string $countryPrefix kod kraju np. GB, PL
	 * @param array $allowedCountries lista dozwolonych prefixów
	 * @param $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorIban($countryPrefix = 'PL', array $allowedCountries = array(), $message = null) {
		return $this->addValidator('iban', array($countryPrefix, $allowedCountries), $message);
	}

	/**
	 * Walidacja całkowitych
	 * @param bool $positive czy tylko naturalne
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorInteger($positive = false, $message = null) {
		return $this->addValidator('integer', array('positive' => $positive), $message);
	}

	/**
	 * Walidacja udziału wielkich liter
	 * @param int $percent maksymalny udział
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorLargeSmall($percent = 40, $message = null) {
		return $this->addValidator('largeSmall', array($percent), $message);
	}

	/**
	 * Walidacja wypełnienia pola
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorNotEmpty($message = null) {
		return $this->addValidator('notEmpty', array(), $message);
	}

	/**
	 * Walidacja od/do
	 * @param mixed $from większa od
	 * @param mixed $to mniejsza od
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorValueBetween($from = null, $to = null, $message = null) {
		return $this->addValidator('numberBetween', array($from, $to), $message);
	}

	/**
	 * Walidacja numeryczna
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorNumeric($message = null) {
		return $this->addValidator('numeric', array(), $message);
	}

	/**
	 * Walidacja numeryczna
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorPostal($message = null) {
		return $this->addValidator('postal', array(), $message);
	}

	/**
	 * Walidacja unikalności rekordu
	 * @param \Mmi\Dao $dao DAO
	 * @param string $fieldName nazwa pola
	 * @param int $id identyfikator istniejącego pola (domyślnie null)
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorRecordUnique($dao, $fieldName, $id = null, $message = null) {
		return $this->addValidator('recordUnique', array($dao, $fieldName, $id), $message);
	}

	/**
	 * Walidacja regex
	 * @param string $pattern wzorzec
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorRegex($pattern, $message = null) {
		return $this->addValidator('regex', array($pattern), $message);
	}

	/**
	 * Walidacja długości ciągu znaków
	 * @param int $from długość od
	 * @param int $to długość do
	 * @param string $message opcjonalny komunikat błędu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addValidatorStringLength($from, $to, $message = null) {
		return $this->addValidator('stringLength', array(intval($from), intval($to)), $message);
	}

}

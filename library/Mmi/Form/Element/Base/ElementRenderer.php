<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element\Base;

abstract class ElementRenderer extends ElementCore {

	/**
	 * Kolejność renderowania pola
	 * @var array
	 */
	protected $_renderingOrder = array(
		'fetchLabel', 'fetchField', 'fetchDescription', 'fetchErrors', 'fetchCustomHtml'
	);

	/**
	 * Renderer pola
	 * @return string
	 */
	public function __toString() {
		try {
			$this->preRender();
			$html = $this->fetchBegin();
			foreach ($this->_renderingOrder as $method) {
				if (!method_exists($this, $method)) {
					continue;
				}
				$html .= $this->{$method}();
			}
			$html .= $this->fetchEnd();
		} catch (\Exception $e) {
			$html = $e->getMessage();
		}
		return $html;
	}

	/**
	 * Ustaw kolejność realizacji
	 * @param array $renderingOrder
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public final function setRenderingOrder(array $renderingOrder = array()) {
		foreach ($renderingOrder as $method) {
			if (!method_exists($this, $method)) {
				throw new\Exception('Unknown rendering method');
			}
		}
		$this->_renderingOrder = $renderingOrder;
		return $this;
	}

	/**
	 * Buduje kontener pola (początek)
	 * @return string
	 */
	public final function fetchBegin() {
		if (isset($this->_options['id'])) {
			$idHtml = 'id="' . $this->_options['id'] . '_container"';
		} else {
			$idHtml = '';
		}
		$class = get_class($this);
		$class = strtolower(substr($class, strrpos($class, '\\') + 1));
		if ($this->hasErrors()) {
			$class .= ' error';
		}
		return '<div class="' . trim($this->getOption('class') . ' ' . $class) . '" ' . $idHtml . '>';
	}

	/**
	 * Buduje kontener pola (koniec)
	 * @return string
	 */
	public final function fetchEnd() {
		return '<div class="clear"></div></div>' . PHP_EOL;
	}

	/**
	 * Buduje etykietę pola
	 * @return string
	 */
	public function fetchLabel() {
		if (!isset($this->_options['label'])) {
			return;
		}
		if (isset($this->_options['id'])) {
			$forHtml = ' for="' . $this->_options['id'] . '" id="' . $this->_options['id'] . '_label"';
		} else {
			$forHtml = '';
		}
		if (isset($this->_options['required']) && $this->_options['required'] && isset($this->_options['markRequired']) && $this->_options['markRequired']) {
			$requiredClass = ' class="required"';
			$required = '<span class="required">' . $this->_options['requiredAsterisk'] . '</span>';
		} else {
			$requiredClass = '';
			$required = '';
		}
		if ($this->_translatorEnabled && ($this->getTranslate() !== null)) {
			$label = $this->getTranslate()->_($this->_options['label']);
		} else {
			$label = $this->_options['label'];
		}
		return '<label' . $forHtml . $requiredClass . '>' . $label . $this->_options['labelPostfix'] . $required . '</label>';
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public abstract function fetchField();

	/**
	 * Buduje opis pola
	 * @return string
	 */
	public final function fetchDescription() {
		if (!isset($this->_options['description'])) {
			return;
		}
		if (isset($this->_options['id'])) {
			$id = ' id="' . $this->_options['id'] . '_description"';
		} else {
			$id = '';
		}
		if ($this->_translatorEnabled && ($this->getTranslate() !== null)) {
			$description = $this->getTranslate()->_($this->_options['description']);
		} else {
			$description = $this->_options['description'];
		}
		return '<div' . $id . ' class="description">' . $description . '</div>';
	}

	/**
	 * Buduje błędy pola
	 * @return string
	 */
	public final function fetchErrors() {
		if (isset($this->_options['id'])) {
			$idHtml = ' id="' . $this->_options['id'] . '_errors"';
		} else {
			$idHtml = '';
		}
		$html = '<div class="errors"' . $idHtml . '>';
		if ($this->hasErrors()) {
			$html .= '<span class="marker"></span>'
				. '<ul>'
				. '<li class="point first"></li>';
			foreach ($this->_errors as $error) {
				if ($this->_translatorEnabled && ($this->getTranslate() !== null)) {
					$err = $this->getTranslate()->_($error);
				} else {
					$err = $error;
				}
				$html .= '<li class="notice error"><i class="icon-remove-sign icon-large"></i>' . $err . '</li>';
			}
			$html .= '<li class="close last"></li>'
				. '</ul>';
		}
		$html .= '<div class="clear"></div></div>';
		return $html;
	}

	/**
	 * Buduje wstrzyknięty kod użytkownika
	 * @return string
	 */
	public final function fetchCustomHtml() {
		if (!isset($this->_options['customHtml'])) {
			return;
		}
		return $this->_options['customHtml'];
	}

}

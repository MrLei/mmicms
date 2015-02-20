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
 * MmiCms/Form.php
 * @category   MmiCms
 * @package    MmiCms\Form
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa formularza CMS
 * @category   MmiCms
 * @package    MmiCms\Form
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace MmiCms;

abstract class Form extends \Mmi\Form {

	/**
	 * Zabezpieczenie spamowe
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Antirobot
	 */
	public function addElementAntirobot($name) {
		return $this->addElement(new \MmiCms\Form\Element\Antirobot($name));
	}
	
	/**
	 * Captcha
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Captcha
	 */
	public function addElementCaptcha($name) {
		return $this->addElement(new \MmiCms\Form\Element\Captcha($name));
	}

	/**
	 * Wybór koloru
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\ColorPicker
	 */
	public function addElementColorPicker($name) {
		return $this->addElement(new \MmiCms\Form\Element\ColorPicker($name));
	}

	/**
	 * Date picker
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\DatePicker
	 */
	public function addElementDatePicker($name) {
		return $this->addElement(new \MmiCms\Form\Element\DatePicker($name));
	}

	/**
	 * Date-time picker
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\DateTimePicker
	 */
	public function addElementDateTimePicker($name) {
		return $this->addElement(new \MmiCms\Form\Element\DateTimePicker($name));
	}

	/**
	 * TinyMce
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\TinyMce
	 */
	public function addElementTinyMce($name) {
		return $this->addElement(new \MmiCms\Form\Element\TinyMce($name));
	}

	/**
	 * Uploader
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Uploader
	 */
	public function addElementUploader($name) {
		return $this->addElement(new \MmiCms\Form\Element\Uploader($name));
	}

}

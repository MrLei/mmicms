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
 * @package    MmiCms_Form
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa formularza CMS
 * @category   MmiCms
 * @package    MmiCms_Form
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
abstract class MmiCms_Form extends Mmi_Form {

	/**
	 * Zabezpieczenie spamowe
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_Antirobot
	 */
	public function addElementAntirobot($name) {
		return $this->addElement(new MmiCms_Form_Element_Antirobot($name));
	}
	
	/**
	 * Captcha
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_Captcha
	 */
	public function addElementCaptcha($name) {
		return $this->addElement(new MmiCms_Form_Element_Captcha($name));
	}

	/**
	 * Wybór koloru
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_ColorPicker
	 */
	public function addElementColorPicker($name) {
		return $this->addElement(new MmiCms_Form_Element_ColorPicker($name));
	}

	/**
	 * Date picker
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_DatePicker
	 */
	public function addElementDatePicker($name) {
		return $this->addElement(new MmiCms_Form_Element_DatePicker($name));
	}

	/**
	 * Date-time picker
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_DateTimePicker
	 */
	public function addElementDateTimePicker($name) {
		return $this->addElement(new MmiCms_Form_Element_DateTimePicker($name));
	}

	/**
	 * TinyMce
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_TinyMce
	 */
	public function addElementTinyMce($name) {
		return $this->addElement(new MmiCms_Form_Element_TinyMce($name));
	}

	/**
	 * Uploader
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_Uploader
	 */
	public function addElementUploader($name) {
		return $this->addElement(new MmiCms_Form_Element_Uploader($name));
	}

}

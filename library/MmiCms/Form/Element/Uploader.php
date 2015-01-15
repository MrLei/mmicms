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
 * MmiCms/Form/Element/Uploader.php
 * @category   MmiCms
 * @package    MmiCms_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa elementu multi-upload plików
 * @category   MmiCms
 * @package    MmiCms_Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class MmiCms_Form_Element_Uploader extends Mmi_Form_Element_File {
	
	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$object = 'library';
		$objectId = null;
		if ($this->getForm()->hasRecord()) {
			$object = $this->getForm()->getFileObjectName();
			$objectId = $this->getForm()->getRecord()->getPk();
		}
		if (!$objectId) {
			$object = 'tmp-' . $object;
			$objectId = Mmi_Session::getNumericId();
		}
		return '<iframe frameborder="0" src="' . Mmi_Controller_Front::getInstance()->getView()->url(array(
			'module' => 'cms',
			'controller' => 'file',
			'action' => 'uploader',
			'class' => get_class($this->getForm()),
			'object' => $object,
			'objectId' => $objectId,
		)) . '"
			style="border-style: none;
			border: none;
			border-width: initial;
			border-color: initial;
			border-image: initial;
			padding: 0;
			margin: 0;
			overflow-x: hidden;
			overflow-y: auto;
			height: 170px;
			width: 100%;"></iframe>';
	}

}
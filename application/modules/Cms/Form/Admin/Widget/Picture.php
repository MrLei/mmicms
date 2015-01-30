<?php

class Cms_Form_Admin_Widget_Picture extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Widget_Picture_Record';

	public function init() {

		$this->addElementFile('cmswidgetpicture')
			->setLabel('Dodaj zdjęcie')
			->setRequired();

		$this->addElementSubmit('submit')
			->setLabel('Zapisz zdjęcie');
	}

	public function isValid($data) {
		$result = parent::isValid($data);
		if ($result === false) {
			$this->_validationResult = false;
		}
		$files = $this->getFiles()[$this->getFileObjectName()];
		if (empty($files)) {
			$this->getElement('cmswidgetpicture')->addError('Wskaż plik zdjęcia');
			$this->_validationResult = false;
		} else {
			$this->_validationResult = true;
		}
		return $this->_validationResult;
	}

	protected function _appendFiles($id, $files) {
		if (empty($files)) {
			return;
		}
		$object = 'cmswidgetpicture';
		//zastapienie obecnego pliku
		Cms_Model_File_Dao::imagesByObjectQuery($object, $id)->find()->delete();
		Cms_Model_File_Dao::appendFiles($object, $id, $files);
	}

}

<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin\Widget;

class Picture extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Widget\Picture\Record';

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
		\Cms\Model\File\Dao::imagesByObjectQuery($object, $id)->find()->delete();
		\Cms\Model\File\Dao::appendFiles($object, $id, $files);
	}

}

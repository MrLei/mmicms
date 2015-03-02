<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace MmiCms\Form\Element;

class Uploader extends \Mmi\Form\Element\File {

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
			$objectId = \Mmi\Session::getNumericId();
		}
		return '<iframe frameborder="0" src="' . \Mmi\Controller\Front::getInstance()->getView()->url(array(
				'module' => 'cms',
				'controller' => 'file',
				'action' => 'uploader',
				'class' => str_replace('\\', '', get_class($this->getForm())),
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

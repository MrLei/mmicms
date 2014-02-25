<?php

class Cms_Controller_File extends Mmi_Controller_Action {

	public function indexAction() {
		$this->view->files = Cms_Model_File_Dao::findClassified($this->_getParam('object'), $this->_getParam('objectId'));
	}

	public function listAction() {
		Mmi_Controller_Front::getInstance()->getResponse()->setHeader('Content-type', 'application/json');
		if (!$this->_getParam('object') || !$this->_getParam('objectId') || !$this->_getParam('hash') || !$this->_getParam('t')) {
			die();
		}
		if ($this->_getParam('hash') != md5(Mmi_Session::getId() . '+' . $this->_getParam('t') . '+' . $this->_getParam('objectId'))) {
			die();
		}
		$files = array();
		foreach (Cms_Model_File_Dao::findImages($this->_getParam('object'), $this->_getParam('objectId')) as $file) {
			$files[] = array('title' => $file->original, 'value' => $file->getUrl('scale', '600'));
		}
		die(json_encode($files));
	}

	public function uploadAction() {
		$files = Mmi_Controller_Front::getInstance()->getRequest()->getFiles();
		if (empty($files)) {
			die();
		}
		if (!$this->_getParam('class')) {
			die();
		}
		if ($this->_getParam('hash') != md5($this->_getParam('t') . '+' . Mmi_Session::getId() . '+' . $this->_getParam('class'))) {
			die();
		}
		$object = $this->_getParam('object');
		$objectId = $this->_getParam('objectId');
		foreach ($files as $currentFile) {
			Cms_Model_File_Dao::appendFiles($object, $objectId, $currentFile);
		}
		die(Mmi_Controller_Front::getInstance()->getView()->widget('cms', 'file', 'uploader', array(
				'object' => $object,
				'objectId' => $objectId
			)));
	}

	public function uploaderAction() {
		$t = round(microtime(true));
		$ajaxParams = array(
			'module' => 'cms',
			'controller' => 'file',
			'action' => 'upload',
			'class' => $this->_getParam('class'),
			't' => $t,
			'object' => $this->_getParam('object'),
			'objectId' => $this->_getParam('objectId'),
			'hash' => md5($t . '+' . Mmi_Session::getId() . '+' . $this->_getParam('class'))
		);
		$this->view->files = Cms_Model_File_Dao::findClassified($this->_getParam('object'), $this->_getParam('objectId'));
		$this->view->ajaxParams = $ajaxParams;
	}

}

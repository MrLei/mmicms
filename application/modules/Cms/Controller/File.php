<?php

class Cms_Controller_File extends Mmi_Controller_Action {

	public function indexAction() {
		$this->view->files = Cms_Model_File_Dao::getClassified($this->object, $this->objectId);
	}

	public function listAction() {
		Mmi_Controller_Front::getInstance()->getResponse()->setHeader('Content-type', 'application/json');
		if (!$this->object || !$this->objectId || !$this->hash || !$this->t) {
			return '';
		}
		if ($this->hash != md5(Mmi_Session::getId() . '+' . $this->t . '+' . $this->objectId)) {
			return '';
		}
		$files = array();
		foreach (Cms_Model_File_Dao::imagesByObjectQuery($this->object, $this->objectId)->find() as $file) {
			$files[] = array('title' => $file->original, 'value' => $file->getUrl('scalex', '990'));
		}
		return json_encode($files);
	}

	public function uploadAction() {
		$files = Mmi_Controller_Front::getInstance()->getRequest()->getFiles();
		if (empty($files)) {
			return '';
		}
		if (!$this->class) {
			return '';
		}
		if ($this->hash != md5($this->t . '+' . Mmi_Session::getId() . '+' . $this->class)) {
			return '';
		}
		$object = $this->object;
		$objectId = $this->objectId;
		Cms_Model_File_Dao::appendFiles($object, $objectId, $files);
		return $this->view->widget('cms', 'file', 'uploader', array(
				'object' => $object,
				'objectId' => $objectId
		));
	}

	public function uploaderAction() {
		$t = round(microtime(true));
		$ajaxParams = array(
			'module' => 'cms',
			'controller' => 'file',
			'action' => 'upload',
			'class' => $this->class,
			't' => $t,
			'object' => $this->object,
			'objectId' => $this->objectId,
			'hash' => md5($t . '+' . Mmi_Session::getId() . '+' . $this->class)
		);
		$this->view->files = Cms_Model_File_Dao::getClassified($this->object, $this->objectId);
		$this->view->ajaxParams = $ajaxParams;
	}

}

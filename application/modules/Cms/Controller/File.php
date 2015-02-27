<?php

namespace Cms\Controller;

class File extends \Mmi\Controller\Action {

	public function indexAction() {
		$this->view->files = \Cms\Model\File\Dao::getClassified($this->object, $this->objectId);
	}

	public function listAction() {
		\Mmi\Controller\Front::getInstance()->getResponse()->setHeader('Content-type', 'application/json');
		if (!$this->object || !$this->objectId || !$this->hash || !$this->t) {
			return '';
		}
		if ($this->hash != md5(\Mmi\Session::getId() . '+' . $this->t . '+' . $this->objectId)) {
			return '';
		}
		$files = array();
		foreach (\Cms\Model\File\Dao::imagesByObjectQuery($this->object, $this->objectId)->find() as $file) {
			$files[] = array('title' => $file->original, 'value' => $file->getUrl('scalex', '990'));
		}
		return json_encode($files);
	}

	public function uploadAction() {
		$files = \Mmi\Controller\Front::getInstance()->getRequest()->getFiles();
		if (empty($files)) {
			return 'Error: no files.';
		}
		if (!$this->class) {
			return 'Error: no class';
		}
		if ($this->hash != md5($this->t . '+' . \Mmi\Session::getId() . '+' . $this->class)) {
			return 'Error: hash invalid';
		}
		$object = $this->object;
		$objectId = $this->objectId;
		\Cms\Model\File\Dao::appendFiles($object, $objectId, $files);
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
			'hash' => md5($t . '+' . \Mmi\Session::getId() . '+' . $this->class)
		);
		$this->view->files = \Cms\Model\File\Dao::getClassified($this->object, $this->objectId);
		$this->view->ajaxParams = $ajaxParams;
	}

}

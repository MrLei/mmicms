<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Acl extends \Cms\Controller\AdminAbstract {

	public function indexAction() {
		$this->view->roles = \Cms\Model\Role\Query::factory()->find();
		if ($this->roleId) {
			$this->view->rules = \Cms\Model\Acl\Dao::getMultioptionsByRoleId($this->roleId);
			$this->view->options = array(null => '---') + \Cms\Model\Reflection::getOptionsWildcard();
		}
		$roleForm = new \Cms\Form\Admin\Role($roleRecord = new \Cms\Model\Role\Record());
		if ($roleForm->isMine() && $roleForm->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie zapisano rolę', true);
			$this->getResponse()->redirect('cms', 'admin-acl', 'index', array('roleId' => $roleRecord->id));
		}
		$aclForm = new \Cms\Form\Admin\Acl(new \Cms\Model\Acl\Record());
		if ($aclForm->isMine() && $aclForm->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie zapisano regułę', true);
			$this->getResponse()->redirect('cms', 'admin-acl', 'index', array('roleId' => $this->roleId));
		}
		$this->view->roleForm = $roleForm;
		$this->view->aclForm = $aclForm;
	}

	public function deleteAction() {
		$this->getResponse()->setTypePlain();
		if (!($this->id > 0)) {
			return 0;
		}
		$rule = \Cms\Model\Acl\Query::factory()->findPk($this->id);
		if ($rule && $rule->delete()) {
			return 1;
		}
	}

	public function updateAction() {
		$msg = $this->view->getTranslate()->_('Zmiana właściwości nie powiodła się.');
		$this->getResponse()->setTypePlain();
		if (!($this->id)) {
			return $msg;
		}
		if (!($this->value)) {
			return $msg;
		}
		$params = explode('-', $this->id);
		if (count($params) != 3) {
			return $msg;
		}
		$model = \Cms\Model\Acl\Query::factory()->findPk($params[2]);
		if (!$model) {
			return;
		}
		if ($params[1] == 'resource') {
			$resource = $this->value;
			$resource = explode(':', $resource);
			$model->module = strtolower($resource[0]);
			$model->controller = isset($resource[1]) ? strtolower($resource[1]) : null;
			$model->action = isset($resource[2]) ? strtolower($resource[2]) : null;
		} else {
			$model->access = $this->value == 'allow' ? 'allow' : 'deny';
		}
		$model->save();
		return 1;
	}

}

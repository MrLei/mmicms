<?php

class Cms_Controller_AdminAcl extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->roles = Cms_Model_Role_Query::factory()->find();		
		if ($this->roleId) {
			$this->view->rules = Cms_Model_Acl_Dao::findPairsByRoleId($this->roleId);
			$reflection = new Admin_Model_Reflection();
			$this->view->options = array(null => '---') + $reflection->getOptionsWildcard();
		}
		$roleForm = new Cms_Form_Admin_Role();
		if ($roleForm->isMine() && $roleForm->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano rolę', true);
			return $this->_helper->redirector('index', 'adminAcl', 'cms', array('roleId' => $roleForm->getRecord()->id));
		}
		$aclForm = new Cms_Form_Admin_Acl();
		if ($aclForm->isMine() && $aclForm->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano regułę', true);
			return $this->_helper->redirector('index', 'adminAcl', 'cms', array('roleId' => $this->roleId));
		}
	}

	public function deleteAction() {
		$this->getResponse()->setTypePlain();
		if (!($this->id > 0)) {
			return 0;
		}
		$rule = new Cms_Model_Acl_Record($this->id);
		$rule->delete();
		return 1;
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
		$model = new Cms_Model_Acl_Record($params[2]);

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

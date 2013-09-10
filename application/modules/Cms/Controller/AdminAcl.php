<?php

class Cms_Controller_AdminAcl extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->roles = Cms_Model_Role_Dao::find();
		if ($this->_getParam('roleId')) {
			$this->view->rules = Cms_Model_Acl_Dao::findPairsByRoleId($this->_getParam('roleId'));
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
			return $this->_helper->redirector('index', 'adminAcl', 'cms', array('roleId' => $this->_getParam('roleId')));
		}
	}

	public function deleteAction() {
		if (!($this->_getParam('id') > 0)) {
			die(0);
		}
		$rule = new Cms_Model_Acl_Record($this->_getParam('id'));
		$rule->delete();
		die('1');
	}

	public function updateAction() {
		$msg = Mmi_Registry::get('Mmi_Translate')->_('Zmiana właściwości nie powiodła się') . '.';
		if (!($this->_getParam('id'))) {
			die($msg);
		}
		if (!($this->_getParam('value'))) {
			die($msg);
		}
		$params = explode('-', $this->_getParam('id'));
		if (count($params) != 3) {
			die($msg);
		}
		$model = new Cms_Model_Acl_Record($params[2]);

		if ($params[1] == 'resource') {
			$resource = $this->_getParam('value');
			$resource = explode(':', $resource);
			$model->module = strtolower($resource[0]);
			$model->controller = isset($resource[1]) ? strtolower($resource[1]) : null;
			$model->action = isset($resource[2]) ? strtolower($resource[2]) : null;
		} else {
			$model->access = $this->_getParam('value') == 'allow' ? 'allow' : 'deny';
		}
		$model->save();
		die('1');
	}

}

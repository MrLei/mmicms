<?php

class Payment_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		$payment = new Payment_Model_Payment();
		$paginator = new Mmi_Paginator();
		$paginator->setRowsCount($payment->getCountMy());
		$this->view->payments = $payment->getMy($paginator->getLimit(), $paginator->getOffset());
		$this->view->paginator = $paginator;
	}

	public function payAction() {
		if (!$this->id) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$payment = new Payment_Model_Payment(intval($this->id));
		if ($payment->cms_auth_id != Default_Registry::$auth->getId()) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$config = new Payment_Model_Config($payment->payment_config_id);
		$config->prepareTransactionData($payment);

		if (!($payment->getId() > 0)) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		if ($this->regenerate > 0) {
			$payment->regenerateSessionId();
		}
		$this->view->payment = $payment;
		$this->view->paymentConfig = $config;
		$this->view->navigation()->modifyLastBreadcrumb('', $this->view->url());
	}

	public function successAction() {
		$this->payAction();
	}

	public function errorAction() {
		$this->payAction();
	}

	public function verifyAction() {
		Mmi_Controller_Front::getInstance()->getView()->setLayoutDisabled();
		$payment = new Payment_Model_Payment();
		$payment->updateStatus($_POST);
	}

}

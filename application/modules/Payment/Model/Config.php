<?php

class Payment_Model_Config extends Mmi_Model {

	protected $_tableName = 'payment_config';

	public function prepareTransactionData(Payment_Model_Payment $payment) {
		if ((!$this->getId() > 0)) {
			return;
		}
		$this->amount = $payment->value * 100;
		$auth = Default_Registry::$auth;
		$this->email = $auth->getEmail();
		$profile = new User_Model_Profile($auth->getId());
		$name = explode(' ', $profile->name);
		$this->name = $name[0];
		$this->surname = (count($name > 1) && isset($name[count($name) - 1])) ? $name[count($name) - 1] : '';
		$this->desc = substr($payment->text, 0, 50);
	}

}

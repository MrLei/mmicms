<?php

class Payment_Controller_Cron extends Mmi_Controller_Action {

	public function verifyTransactionsAction() {
		$payment = new Payment_Model_Payment();
		$this->view->result = $payment->verifyTransactions();
	}

}
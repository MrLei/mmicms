<?php

class Payment_Model_Payment extends Mmi_Model {

	protected $_tableName = 'payment';

	public function getMy($limit = 10, $offset = 0) {
		$id = Default_Registry::$auth->getId();
		if (!($id > 0)) {
			return;
		}
		return parent::getAll(array('cms_auth_id', $id), array('dateAdd', 'DESC'), $limit, $offset);
	}

	public function getAllAccepted() {
		return $this->getAll(array(
			array('status', 3)
		));
	}

	public function getCountMy() {
		$id = Default_Registry::$auth->getId();
		if (!($id > 0)) {
			return;
		}
		return parent::getCount(array('cms_auth_id', $id));
	}

	public function addPayment($cmsAuthId, $configName, $value, $text) {
		$this->cms_auth_id = $cmsAuthId;
		$config = new Payment_Model_Config();
		$config->get(array(
			'name', $configName
		));
		if (!($config->getId() > 0)) {
			return;
		}
		$this->value = $value;
		$this->payment_config_id = $config->getId();
		$this->dateAdd = date('Y-m-d H:i:s');
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->text = $text;
		$this->sessionId = md5($this->ip . $this->text . $this->cms_auth_id . microtime(true));
		$this->status = 0;
		if ($this->value == 0) {
			$this->status = 3;
		}
		$id = $this->save();
		$auth = new Cms_Model_Auth($cmsAuthId);
		Mail_Model_Mail::pushEmail('payment_started', $auth->email, $this->toArray());
		return $id;
	}

	public function regenerateSessionId() {
		if (!($this->getId() > 0)) {
			return;
		}
		$this->status = 0;
		$this->sessionId = md5($this->ip . $this->text . $this->cms_auth_id . microtime(true));
		return $this->save();
	}

	public function verifyTransactions() {
		$effect = array('accepted' => 0, 'rejected' => 0, 'errors' => 0);
		$client = new SoapClient('https://www.platnosci.pl/paygw/webapi/Payments?wsdl');
		$payments = $this->getAll(array(
			'status', 1
		));
		$ts = microtime(true)*10000;
		foreach ($payments as $payment) {
			$auth = new Cms_Model_Auth($payment->cms_auth_id);
			$config = new Payment_Model_Config($payment->payment_config_id);
			$result = $client->get($config->shopId, $payment->sessionId, $ts, md5($config->shopId . $payment->sessionId . (string)$ts . $config->key1));
			$valueMatch = (100*$payment->value) == $result->transAmount;
			$signatureMatch = ($result->transSig == md5($config->shopId . $payment->sessionId . $payment->id . $result->transStatus . $result->transAmount . $result->transDesc . $result->transTs . $config->key2));
			if (!$signatureMatch) {
				$effect['errors']++;
				continue;
			}
			$payment->dateEnd = date('Y-m-d H:i:s');
			if (!$valueMatch || $result->transStatus == 2 || $result->transStatus == 3 || $result->transStatus == 7) {
				$payment->status = 2;
				$payment->save();
				Mail_Model_Mail::pushEmail('payment_rejected', $auth->email, $payment->toArray());
				Stat_Model_Stat::hit('payment_rejected');
				$effect['rejected']++;
				continue;
			}
			if ($result->transStatus == 99) {
				$payment->status = 3;
				$payment->type = $result->transPayType;
				$payment->save();
				Mail_Model_Mail::pushEmail('payment_accepted', $auth->email, $payment->toArray());
				Stat_Model_Stat::hit('payment_accepted');
				$effect['accepted']++;
				continue;
			}
		}
		return $effect;
	}

	public function addMyPayment($configName, $value, $text) {
		return $this->addPayment(Default_Registry::$auth->getId(), $configName, $value, $text);
	}

	public function updateStatus(array $params) {
		if (!isset($params['pos_id']) || !isset($params['ts']) || !isset($params['session_id']) || !isset($params['sig'])) {
			Mmi_Log::add('payU missing params', $params);
			return;
		}
		$this->get(array(
			array('status', 0),
			array('sessionId', $params['session_id'])
		));
		if (!($this->getId() > 0)) {
			Mmi_Log::add('payU no payment', $params);
			return;
		}
		$config = new Payment_Model_Config($this->payment_config_id);
		if (md5($config->shopId . $params['session_id'] . $params['ts'] . $config->key2) != $params['sig']) {
			Mmi_Log::add('payU fail', $params);
			return;
		}
		$this->status = 1;
		$id = $this->save();
		$params['paymentId'] = $this->id;
		$params['paymentText'] = $this->text;
		$params['paymentValue'] = $this->value;
		Mmi_Log::add('payU status', $params);
		return $id;
	}

}

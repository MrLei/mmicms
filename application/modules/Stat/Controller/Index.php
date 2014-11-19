<?php

class Stat_Controller_Index extends Mmi_Controller_Action {

	public function hitAction() {
		if (!$this->s) {
			return $this->_out(0);
		}
		$data = base64_decode($this->s);
		$data = explode(',', $data);
		if (!(isset($data[0])) || preg_replace('/[^a-z_]+/', '', $data[0]) != $data[0]) {
			return $this->_out(0);
		}
		if (!isset($data[1])) {
			$data[1] = null;
		} elseif (strlen($data[1]) == strlen(intval($data[1]))) {
			$data[1] = intval($data[1]);
		} else {
			return $this->_out(0);
		}
		Stat_Model_Dao::hit($data[0], $data[1]);
		return $this->_out(1);
	}

	protected function _out($message) {
		$this->getResponse()->setTypeJs();
		return '//' . $message;
	}

}

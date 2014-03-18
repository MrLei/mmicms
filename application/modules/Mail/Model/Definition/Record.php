<?php

/**
 * @property integer $id
 * @property string $lang
 * @property integer $mail_server_id
 * @property string $name
 * @property string $replyTo
 * @property string $fromName
 * @property string $subject
 * @property string $message
 * @property integer $html
 * @property string $dateAdd
 * @property string $dateModify
 * @property integer $active
 */
class Mail_Model_Definition_Record extends Mmi_Dao_Record {

	protected function _update() {
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::_update();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}

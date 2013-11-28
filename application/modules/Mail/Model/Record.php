<?php

/**
 * @property integer $id
 * @property integer $mail_definition_id
 * @property string $fromName
 * @property string $to
 * @property string $replyTo
 * @property string $subject
 * @property string $message
 * @property string $attachements
 * @property integer $type
 * @property string $dateAdd
 * @property string $dateSent
 * @property string $dateSendAfter
 * @property integer $active
 */
class Mail_Model_Record extends Mmi_Dao_Record {

	protected function _update() {
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::_update();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}

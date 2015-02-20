<?php


namespace Cms\Model\Mail;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $mailDefinitionId;
	public $fromName;
	public $to;
	public $replyTo;
	public $subject;
	public $message;
	public $attachements;
	public $type;
	public $dateAdd;
	public $dateSent;
	public $dateSendAfter;
	public $active;

	protected function _update() {
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::_update();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}

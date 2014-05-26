<?php

class Admin_Form_Trace extends Mmi_Form {

	public function init() {

		$this->addElementTextarea('trace')
			->setLabel('Ślad');

		$this->addElementSubmit('login')
			->setLabel('Dekoduj');

	}

}
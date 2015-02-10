<?php

class Tutorial_Form_Transfer extends Mmi_Form {

	public function init() {

		$this->addElementSubmit('next')
			->setLabel('przejdź >>');
	}

}

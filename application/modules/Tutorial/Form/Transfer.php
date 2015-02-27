<?php

namespace Tutorial\Form;

class Transfer extends \Mmi\Form {

	public function init() {

		$this->addElementSubmit('next')
			->setLabel('przejdź >>');
	}

}

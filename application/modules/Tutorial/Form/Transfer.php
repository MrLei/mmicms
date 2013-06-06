<?php

class Tutorial_Form_Transfer extends Mmi_Form {
	
	public function init() {
		$this->addElement('submit', 'next', array(
			'label' => 'przejdź >>'
		));
	}	
}
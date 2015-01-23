<?php

class Cms_Form_Admin_Widget_Text extends MmiCms_Form {

	public function init() {

		$this->addElementTextarea('text')
			->setLabel('Tekst');
		
	}

}

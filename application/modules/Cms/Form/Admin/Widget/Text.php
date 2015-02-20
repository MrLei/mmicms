<?php


namespace Cms\Form\Admin\Widget;

class Text extends \MmiCms\Form {

	protected $_recordName = '\Cms\Model\Widget\Text\Record';
	
	public function init() {

		$this->addElementTextarea('data')
			->setLabel('Tekst');
		
		$this->addElementSubmit('submit')
			->setLabel('Zapisz');
		
	}

}

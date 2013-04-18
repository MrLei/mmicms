<?php

class Cms_Form_Admin_Container extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Record';

	public function init() {

		$this->addElement('text', 'title', array(
			'label' => 'tytuł'
		));

		$this->addElement('tinyMce', 'lead', array(
			'label' => 'lead',
			'value' => $this->getRecord()->getLead()
		));
		
		$this->addElement('tinyMce', 'text', array(
			'label' => 'opis',
			'value' => $this->getRecord()->getText()
		));

		$leftBoxes = $this->getRecord()->getLeftBoxes(false);
		$rightBoxes = $this->getRecord()->getRightBoxes(false);
		$boxes = array(null => '---') + Box_Model_Dao::findPairs('id', 'name');
		
		$this->addElement('label', 'left-column', array(
			'label' => 'Lewa kolumna'
		));

		for ($i = 1 ; $i < 4 ; $i++) {
			$this->addElement('select', 'left-box-' . $i, array(
				'multiOptions' => $boxes,
				'value' => isset($leftBoxes[$i]) ? $leftBoxes[$i]['box'] : null,
				'label' => 'box'
			));
			$this->addElement('text', 'left-box-' . $i . '-params', array(
				'label' => 'parametry',
				'value' => isset($leftBoxes[$i]) ? $leftBoxes[$i]['params'] : '',
			));
		}

		$this->addElement('label', 'right-column', array(
			'label' => 'Prawa kolumna'
		));

		for ($i = 1 ; $i < 5 ; $i++) {
			$this->addElement('select', 'right-box-' . $i, array(
				'multiOptions' => $boxes,
				'value' => isset($rightBoxes[$i]) ? $rightBoxes[$i]['box'] : null,
				'label' => 'box'
			));
			$this->addElement('text', 'right-box-' . $i . '-params', array(
				'label' => 'parametry',
				'value' => isset($rightBoxes[$i]) ? $rightBoxes[$i]['params'] : '',
			));
		}

		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz stronę'
		));
	}

}

<?php

class Stat_Form_Admin_Object extends Mmi_Form {

	public function init() {
		$this->addElement('select', 'object', array(
			'value' => $this->getOption('object'),
			'label' => 'statystyka',
			'multiOptions' => array(null => '---') + Stat_Model_Label_Dao::findPairs('object', 'label', array(), array('label'))
		));

		$years = array(date('Y') - 1 => date('Y') - 1, date('Y') => date('Y'));

		$this->addElement('select', 'year', array(
			'value' => $this->getOption('year'),
			'label' => 'rok',
			'multiOptions' => $years
		));

		$view = Mmi_View::getInstance();

		$this->addElement('select', 'month', array(
			'value' => $this->getOption('month'),
			'label' => 'miesiąc',
			'multiOptions' => array(1 => $view->getTranslate()->_('styczeń'),
				2 => $view->getTranslate()->_('luty'),
				3 => $view->getTranslate()->_('marzec'),
				4 => $view->getTranslate()->_('kwiecień'),
				5 => $view->getTranslate()->_('maj'),
				6 => $view->getTranslate()->_('czerwiec'),
				7 => $view->getTranslate()->_('lipiec'),
				8 => $view->getTranslate()->_('sierpień'),
				9 => $view->getTranslate()->_('wrzesień'),
				10 => $view->getTranslate()->_('październik'),
				11 => $view->getTranslate()->_('listopad'),
				12 => $view->getTranslate()->_('grudzień'),
			)
		));
	}

}

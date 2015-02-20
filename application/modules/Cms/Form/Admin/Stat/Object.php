<?php


namespace Cms\Form\Admin\Stat;

class Object extends \Mmi\Form {

	public function init() {

		$this->addElementSelect('object')
			->setLabel('statystyka')
			->setValue($this->getOption('object'))
			->setMultiOptions(array(null => '---') + \Cms\Model\Stat\Label\Query::factory()->orderAsc('label')->findPairs('object', 'label'));

		$this->addElementSelect('year')
			->setLabel('rok')
			->setValue($this->getOption('year'))
			->setMultiOptions(array(date('Y') - 1 => date('Y') - 1, date('Y') => date('Y')));

		$view = \Mmi\Controller\Front::getInstance()->getView();

		$this->addElementSelect('month')
			->setLabel('miesiąc')
			->setValue($this->getOption('month'))
			->setMultiOptions(array(1 => $view->getTranslate()->_('styczeń'),
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
		));
	}

}

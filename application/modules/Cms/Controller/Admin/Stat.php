<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Stat extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$year = $this->year ? $this->year : date('Y');
		$month = $this->month ? $this->month : date('m');
		$form = new \Cms\Form\Admin\Stat\Object(null, array('object' => $this->object,
			'year' => $year,
			'month' => $month,
		));
		$this->view->objectForm = $form;
		if ($form->isMine()) {
			if ($form->getValue('object') && $form->getValue('month') >= 1 && $form->getValue('month') <= 12 && $form->getValue('year') <= date('Y')) {
				$this->getResponse()->redirect('cms', 'admin-stat', 'index', array('object' => $form->getValue('object'),
					'year' => $form->getValue('year'),
					'month' => $form->getValue('month'),
					));
			}
			$this->getResponse()->redirect('cms', 'admin-stat', 'index', array('year' => $form->getValue('year'),
				'month' => $form->getValue('month'),
				));
		}
		if (!$this->object || !$this->year || !$this->month) {
			return;
		}
		$object = $this->object;
		$year = intval($year);
		$month = intval($month);
		$label = \Cms\Model\Stat\Label\Dao::byObjectQuery($object)
			->findFirst();
		if ($label === null) {
			return;
		}
		$this->view->label = $label;
		//staty dzienne

		$prevMonth = ($month - 1) > 0 ? $month - 1 : 12;
		$prevYear = ($prevMonth == 12) ? $year - 1 : $year;
		$day = (ltrim(date('m'), '0') == $month) ? date('d') : date('t', strtotime($year . '-' . $month));

		//staty dzienne
		$this->view->dailyChart = \Cms\Model\Stat\Date\Dao::flotCode('dailyChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('dni'),
					'data' => \Cms\Model\Stat\Date\Dao::toDate($object, null, $year, $month, $day)
				),
				array('object' => $label->object,
					'label' => $this->view->_('Poprzedni miesiąc: dni'),
					'data' => \Cms\Model\Stat\Date\Dao::toDate($object, null, $prevYear, $prevMonth, $day)
				)
				), 'lines', true);
		//staty miesięczne
		$this->view->monthlyChart = \Cms\Model\Stat\Date\Dao::flotCode('monthlyChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('miesiące'),
					'data' => \Cms\Model\Stat\Date\Dao::monthly($object, null, $year)
				)
				), 'bars');
		//staty roczne
		$this->view->yearlyChart = \Cms\Model\Stat\Date\Dao::flotCode('yearlyChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('lata'),
					'data' => \Cms\Model\Stat\Date\Dao::yearly($object, null)
				)
				), 'bars');
		//rozkład godzinowy
		$this->view->avgHourlyChart = \Cms\Model\Stat\Date\Dao::flotCode('avgHourlyChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('rozkład godzinowy'),
					'data' => \Cms\Model\Stat\Date\Dao::avgHourly($object, null, $year, $month)
				)
				), 'bars');
		//rozkład godzinowy
		$this->view->avgHourlyAllChart = \Cms\Model\Stat\Date\Dao::flotCode('avgHourlyAllChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('rozkład ogólny'),
					'data' => \Cms\Model\Stat\Date\Dao::avgHourly($object, null, null, null)
				)
				), 'bars');
	}

	public function labelAction() {
		$this->view->grid = new \Cms\Plugin\StatLabelGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Stat\Label(new \Cms\Model\Stat\Label\Record($this->id));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Nazwa statystyki została zapisana', true);
			$this->getResponse()->redirect('cms', 'admin-stat', 'label');
		}
		$this->view->labelForm = $form;
	}

	public function deleteAction() {
		$label = \Cms\Model\Stat\Label\Query::factory()->findPk($this->id);
		if ($label && $label->delete()) {
			$this->getMessenger()->addMessage('Nazwa statystyki została usunięta', true);
		}
		$this->getResponse()->redirect('cms', 'admin-stat', 'label');
	}

}

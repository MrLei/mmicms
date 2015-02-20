<?php


namespace Cms\Controller\Admin;

class Stat extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$year = $this->year ? $this->year : date('Y');
		$month = $this->month ? $this->month : date('m');
		$form = new \Cms\Form\Admin\Stat\Object(null, array('object' => $this->object,
			'year' => $year,
			'month' => $month,
		));
		if ($form->isMine()) {
			if ($form->getValue('object') && $form->getValue('month') >= 1 && $form->getValue('month') <= 12 && $form->getValue('year') <= date('Y')) {
				$this->_helper->redirector('index', 'admin-stat', 'cms', array('object' => $form->getValue('object'),
					'year' => $form->getValue('year'),
					'month' => $form->getValue('month'),
					), true);
			}
			$this->_helper->redirector('index', 'admin-stat', 'cms', array('year' => $form->getValue('year'),
				'month' => $form->getValue('month'),
				), true);
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
		$form = new \Cms\Form\Admin\Stat\Label($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Nazwa statystyki została zapisana', true);
			$this->_helper->redirector('label', 'admin-stat', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$label = \Cms\Model\Stat\Label\Dao::findPk($this->id);
		if ($label && $label->delete()) {
			$this->_helper->messenger('Nazwa statystyki została usunięta', true);
		}
		$this->_helper->redirector('label', 'admin-stat', 'cms', array(), true);
	}

}

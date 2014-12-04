<?php

class Stat_Controller_Admin extends MmiCms_Controller_Admin {

	public function indexAction() {
		$year = $this->year ? $this->year : date('Y');
		$month = $this->month ? $this->month : date('m');
		$form = new Stat_Form_Admin_Object(null, array('object' => $this->object,
			'year' => $year,
			'month' => $month,
		));
		if ($form->isMine()) {
			if ($form->getValue('object') && $form->getValue('month') >= 1 && $form->getValue('month') <= 12 && $form->getValue('year') <= date('Y')) {
				$this->_helper->redirector('index', 'admin', 'stat', array('object' => $form->getValue('object'),
					'year' => $form->getValue('year'),
					'month' => $form->getValue('month'),
					), true);
			}
			$this->_helper->redirector('index', 'admin', 'stat', array('year' => $form->getValue('year'),
				'month' => $form->getValue('month'),
				), true);
		}
		if (!$this->object || !$this->year || !$this->month) {
			return;
		}
		$object = $this->object;
		$year = intval($year);
		$month = intval($month);
		$label = Stat_Model_Label_Dao::byObjectQuery($object)
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
		$this->view->dailyChart = Stat_Model_Date_Dao::flotCode('dailyChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('dni'),
					'data' => Stat_Model_Date_Dao::toDate($object, null, $year, $month, $day)
				),
				array('object' => $label->object,
					'label' => $this->view->_('Poprzedni miesiąc: dni'),
					'data' => Stat_Model_Date_Dao::toDate($object, null, $prevYear, $prevMonth, $day)
				)
				), 'lines', true);
		//staty miesięczne
		$this->view->monthlyChart = Stat_Model_Date_Dao::flotCode('monthlyChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('miesiące'),
					'data' => Stat_Model_Date_Dao::monthly($object, null, $year)
				)
				), 'bars');
		//staty roczne
		$this->view->yearlyChart = Stat_Model_Date_Dao::flotCode('yearlyChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('lata'),
					'data' => Stat_Model_Date_Dao::yearly($object, null)
				)
				), 'bars');
		//rozkład godzinowy
		$this->view->avgHourlyChart = Stat_Model_Date_Dao::flotCode('avgHourlyChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('rozkład godzinowy'),
					'data' => Stat_Model_Date_Dao::avgHourly($object, null, $year, $month)
				)
				), 'bars');
		//rozkład godzinowy
		$this->view->avgHourlyAllChart = Stat_Model_Date_Dao::flotCode('avgHourlyAllChart', array(
				array('object' => $label->object,
					'label' => $label->label . ': ' . $this->view->_('rozkład ogólny'),
					'data' => Stat_Model_Date_Dao::avgHourly($object, null, null, null)
				)
				), 'bars');
	}

	public function labelAction() {
		$this->view->grid = new Stat_Plugin_LabelGrid();
	}

	public function editAction() {
		$form = new Stat_Form_Admin_Label($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Nazwa statystyki została zapisana', true);
			$this->_helper->redirector('label', 'admin', 'stat', array(), true);
		}
	}

	public function deleteAction() {
		$label = new Stat_Model_Label(intval($this->id));
		$label->delete();
		$this->_helper->messenger('Nazwa statystyki została usunięta', true);
		$this->_helper->redirector('label', 'admin', 'stat', array(), true);
	}

}

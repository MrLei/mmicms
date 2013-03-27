<?php

class Stat_Controller_Admin extends MmiCms_Controller_Admin {

	public function indexAction() {
		$year = $this->_getParam('year') ? $this->_getParam('year') : date('Y');
		$month = $this->_getParam('month') ? $this->_getParam('month') : date('m');
		$form = new Stat_Form_Admin_Object(null, array('object' => $this->_getParam('object'),
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
		if (!$this->_getParam('object') || !$this->_getParam('year') || !$this->_getParam('month')) {
			return;
		}
		$object = $this->_getParam('object');
		$year = intval($year);
		$month = intval($month);
		$label = Stat_Model_Label_Dao::findFirst(array('object', $object));
		if ($label === null) {
			return;
		}
		$this->view->label = $label;
		//staty dzienne

		$prevMonth = ($month - 1) > 0 ? $month - 1 : 12;
		$prevYear = ($prevMonth == 12) ? $year - 1 : $year;

		$this->view->dailyChart = Stat_Model_Date_Dao::flotCode('dailyChart', array(
			array('object' => $label->object,
				'label' => $label->label . ': ' . $this->view->_('dni'),
				'data' => Stat_Model_Date_Dao::toDate($object, null, $year, $month, date('d'))
			),
			array('object' => $label->object,
				'label' => $this->view->_('Poprzedni miesiąc: dni'),
				'data' => Stat_Model_Date_Dao::toDate($object, null, $prevYear, $prevMonth, date('d'))
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
		$form = new Stat_Form_Admin_Label($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Nazwa statystyki została zapisana', true);
			$this->_helper->redirector('label', 'admin', 'stat', array(), true);
		}
	}

	public function deleteAction() {
		$label = new Stat_Model_Label(intval($this->_getParam('id')));
		$label->delete();
		$this->_helper->messenger('Nazwa statystyki została usunięta');
		$this->_helper->redirector('label', 'admin', 'stat', array(), true);
	}

}
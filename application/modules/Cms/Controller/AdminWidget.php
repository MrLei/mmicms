<?php

class Cms_Controller_AdminWidget extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_WidgetGrid();
	}

	public function textWidgetEditAction() {
		$widgetData = Cms_Model_Widget_Text_Dao::findPk($this->id);
		if ($widgetData != null) {
			$this->view->textId = $widgetData->id;
		}

		$this->view->grid = new Cms_Plugin_TextWidgetGrid();

		$form = new Cms_Form_Admin_Widget_Text($widgetData);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zawartość została dodana do widgetu');
			$this->_helper->redirector('textWidgetEdit', 'adminWidget', 'cms', array(), true);
		}
	}

	public function textWidgetDeleteAction() {
		if (null !== ($record = Cms_Model_Widget_Text_Dao::findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Zawartość usunięta poprawnie');
		}
		$this->_helper->redirector('textWidgetEdit', 'adminWidget', 'cms', array(), true);
	}

	public function pictureWidgetEditAction() {
		$this->view->grid = new Cms_Plugin_PictureWidgetGrid();

		$form = new Cms_Form_Admin_Widget_Picture();
		if ($form->isSaved()) {
			$this->_helper->messenger('Zawartość została dodana do widgetu');
			$this->_helper->redirector('pictureWidgetEdit', 'adminWidget', 'cms', array(), true);
		}
	}

	public function pictureWidgetDeleteAction() {
		if (null !== ($record = Cms_Model_Widget_Picture_Dao::findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Zawartość usunięta poprawnie');
		}
		$this->_helper->redirector('pictureWidgetEdit', 'adminWidget', 'cms', array(), true);
	}

}

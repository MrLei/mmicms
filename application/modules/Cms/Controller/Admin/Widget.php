<?php

class Cms_Controller_Admin_Widget extends MmiCms_Controller_Admin {

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
			$this->_helper->messenger('Tekst został dodany');
			$this->_helper->redirector('textWidgetEdit', 'adminWidget', 'cms', array(), true);
		}
	}

	public function textWidgetDeleteAction() {
		if (null !== ($record = Cms_Model_Widget_Text_Dao::findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Tekst usunięty poprawnie');
		}
		$this->_helper->redirector('textWidgetEdit', 'adminWidget', 'cms', array(), true);
	}

	public function pictureWidgetEditAction() {
		$pictureRec = Cms_Model_Widget_Picture_Dao::findPk($this->id);
		if ($pictureRec != null) {
			$this->view->pictureId = $pictureRec->id;
		}
		$this->view->grid = new Cms_Plugin_PictureWidgetGrid();

		$form = new Cms_Form_Admin_Widget_Picture($pictureRec);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zdjęcie zostało zapisane');
			$this->_helper->redirector('pictureWidgetEdit', 'adminWidget', 'cms', array(), true);
		}
	}

	public function pictureWidgetDeleteAction() {
		if (null !== ($record = Cms_Model_Widget_Picture_Dao::findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Zdjęcie usunięte poprawnie');
		}
		$this->_helper->redirector('pictureWidgetEdit', 'adminWidget', 'cms', array(), true);
	}

}

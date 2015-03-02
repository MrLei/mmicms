<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Widget extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\WidgetGrid();
	}

	public function textWidgetEditAction() {
		$widget = \Cms\Model\Widget\Text\Query::factory()->findPk($this->id);
		if ($widget !== null) {
			$this->view->textId = $widget->id;
		}

		$this->view->grid = new \Cms\Plugin\TextWidgetGrid();

		$form = new \Cms\Form\Admin\Widget\Text($widget);
		if ($form->isSaved()) {
			$this->_helper->messenger('Tekst został dodany');
			$this->_helper->redirector('textWidgetEdit', 'admin-widget', 'cms', array(), true);
		}
	}

	public function textWidgetDeleteAction() {
		if (null !== ($record = \Cms\Model\Widget\Text\Query::factory()->findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Tekst usunięty poprawnie');
		}
		$this->_helper->redirector('textWidgetEdit', 'admin-widget', 'cms', array(), true);
	}

	public function pictureWidgetEditAction() {
		$pictureRec = \Cms\Model\Widget\Picture\Query::factory()->findPk($this->id);
		if ($pictureRec != null) {
			$this->view->pictureId = $pictureRec->id;
		}
		$this->view->grid = new \Cms\Plugin\PictureWidgetGrid();

		$form = new \Cms\Form\Admin\Widget\Picture($pictureRec);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zdjęcie zostało zapisane');
			$this->_helper->redirector('pictureWidgetEdit', 'admin-widget', 'cms', array(), true);
		}
	}

	public function pictureWidgetDeleteAction() {
		if (null !== ($record = \Cms\Model\Widget\Picture\Query::factory()->findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Zdjęcie usunięte poprawnie');
		}
		$this->_helper->redirector('pictureWidgetEdit', 'admin-widget', 'cms', array(), true);
	}

}

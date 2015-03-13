<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Widget extends \Cms\Controller\AdminAbstract {

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
			$this->getMessenger()->addMessage('Tekst został dodany');
			$this->getResponse()->redirect('cms', 'admin-widget', 'textWidgetEdit');
		}
		$this->view->textForm = $form;
	}

	public function textWidgetDeleteAction() {
		if (null !== ($record = \Cms\Model\Widget\Text\Query::factory()->findPk($this->id)) && $record->delete()) {
			$this->getMessenger()->addMessage('Tekst usunięty poprawnie');
		}
		$this->getResponse()->redirect('cms', 'admin-widget', 'textWidgetEdit');
	}

	public function pictureWidgetEditAction() {
		$pictureRec = \Cms\Model\Widget\Picture\Query::factory()->findPk($this->id);
		if ($pictureRec != null) {
			$this->view->pictureId = $pictureRec->id;
		}
		$this->view->grid = new \Cms\Plugin\PictureWidgetGrid();

		$form = new \Cms\Form\Admin\Widget\Picture($pictureRec);
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Zdjęcie zostało zapisane');
			$this->getResponse()->redirect('cms', 'admin-widget', 'pictureWidgetEdit');
		}
		$this->view->pictureForm = $form;
	}

	public function pictureWidgetDeleteAction() {
		if (null !== ($record = \Cms\Model\Widget\Picture\Query::factory()->findPk($this->id)) && $record->delete()) {
			$this->getMessenger()->addMessage('Zdjęcie usunięte poprawnie');
		}
		$this->getResponse()->redirect('cms', 'admin-widget', 'pictureWidgetEdit');
	}

}

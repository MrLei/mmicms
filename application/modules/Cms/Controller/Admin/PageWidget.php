<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class PageWidget extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\PageWidgetGrid();
	}

	public function editAction() {
		$widget = \Cms\Model\Page\Widget\Query::factory()->findPk($this->id);

		if ($widget !== null) {
			$this->widget = ucfirst($widget->module) . ':' . ucfirst($widget->controller) . ':' . $widget->action;
		}

		$form = new \Cms\Form\Admin\Page\Widget($widget, array(
			'widget' => $this->widget
		));

		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Widget zapisany poprawnie');
			$this->getResponse()->redirect('cms', 'admin-pageWidget');
		}
		$this->view->widgetForm = $form;		
	}

	public function deleteAction() {
		$record = \Cms\Model\Page\Widget\Query::factory()->findPk($this->id);
		if ($record !== null && $record->delete()) {
			$this->getMessenger()->addMessage('Widget zostal usuniety');
		}
		$this->getResponse()->redirect('cms', 'admin-pageWidget');
	}

}

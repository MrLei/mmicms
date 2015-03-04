<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class MailDefinition extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$grid = new \Cms\Plugin\MailDefinitionGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Mail\Definition(new \Cms\Model\Mail\Definition\Record($this->id));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie zapisano definicję maila', true);
			$this->getResponse()->redirect('cms', 'admin-mailDefinition');
		}
		$this->view->definitionForm = $form;
	}

	public function deleteAction() {
		$definition = \Cms\Model\Mail\Definition\Query::factory()->findPk($this->id);
		try {
			if ($definition && $definition->delete()) {
				$this->getMessenger()->addMessage('Poprawnie skasowano definicję maila');
			}
		} catch (\Mmi\Db\Exception $e) {
			$this->getMessenger()->addMessage('Nie można usunąć definicji maila, istnieją powiazane wiadomosci w kolejce', false);
		}
		$this->getResponse()->redirect('cms', 'admin-mailDefinition');
	}

}

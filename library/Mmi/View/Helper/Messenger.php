<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\View\Helper;

class Messenger extends HelperAbstract {

	/**
	 * Metoda główna, wyświetla i czyści dostępne wiadomości
	 * @return string
	 */
	public function messenger() {
		$messenger = \Mmi\Controller\Action\HelperBroker::getHelper('messenger');
		$messages = $messenger->getMessages();
		if ($messenger->hasMessages()) {
			$html = '<ul id="messenger">';
			foreach ($messages as $message) {
				$class = ' class="notice warning"';
				$icon = '<i class="icon-warning-sign icon-large"></i>';
				if ($message['type']) {
					$class = ' class="notice ' . $message['type'] . '"';
					$icon = '<i class="icon-ok icon-large"></i>';
					if ($message['type'] == 'error') {
						$icon = '<i class="icon-remove-sign icon-large"></i>';
					}
				}
				$html .= '<li' . $class . '>' . $icon . $message['message'] . '</li>';
			}
			$html .= '</ul>';
			$messenger->clearMessages();
			return $html;
		}
	}

}

<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/View/Helper/Messenger.php
 * @category   Mmi
 * @package    \Mmi\View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Helper odczytu i kasowania wiadomości
 * @see \Mmi\Controller\Action\Helper\Messenger
 * @category   Mmi
 * @package    \Mmi\View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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

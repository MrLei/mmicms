<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

abstract class Form extends Form\Base\Form {

	/**
	 * Konstruktor
	 * @param \Mmi\Dao\Record $record obiekt recordu
	 * @param array $options opcje
	 */
	public function __construct(\Mmi\Dao\Record $record = null, array $options = array()) {
		$this->setOptions($options);
		$this->_record = $record;
		$this->_className = get_class($this);
		$this->_formBaseName = strtolower(substr($this->_className, strrpos($this->_className, '\\') + 1));
		$this->_request = \Mmi\Controller\Front::getInstance()->getRequest();
		$this->_saved = false;

		//domyślne opcje
		$this->setOption('class', 'form_' . $this->_formBaseName)
			->setOption('accept-charset', 'utf-8')
			->setOption('method', 'post')
			->setOption('enctype', 'multipart/form-data');

		//dane z rekordu
		if ($this->hasNotEmptyRecord()) {
			$data = $this->_record->toArray();
		}
		
		//dane z POST
		if ($this->isMine()) {
			$data = $this->_request->getPost()->toArray();
		}
		
		//inicjalizacja formularza
		$this->init();

		//jeśli zabezpieczony formularz, odczytujemy hash z sesji
		$this->_hash = md5($this->_className);
		if (!isset($options['ajax']) && $this->_secured) {
			$this->_sessionNamespace = new \Mmi\Session\Space('\Mmi\Form');
			$this->_hash = $this->_sessionNamespace->{$this->_formBaseName};
		}

		//konfiguracja elementów
		$this->_configureElements();

		//jeśli przyszły dane - ustawienie w pola
		if (isset($data)) {
			//ustawienie wartości domyślnych
			$this->setDefaults($this->prepareLoadData($data));
		}
		
		//zapis do rekordu jeśli istnieje
		$this->save();
		$this->lateInit();

		//nowy hash
		if (!isset($options['ajax']) && $this->_secured) {
			$this->_sessionNamespace = new \Mmi\Session\Space('\Mmi\Form');
			$this->_sessionNamespace->{$this->_formBaseName} = ($this->_hash = md5($this->_className . microtime(true)));
		}
		//tworzenie pola ctrl
		$this->addElementHidden($this->_formBaseName . '__ctrl')
			->setIgnore()
			->setOption('id', $this->_formBaseName . '__ctrl')
			->setValue(\Mmi\Lib::hashTable(array('hash' => $this->_hash, 'class' => $this->_className, 'options' => $this->getOptions())));
	}

}

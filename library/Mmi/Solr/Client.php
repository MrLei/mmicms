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
 * Mmi/Solr/Client.php
 * @category   Mmi
 * @package    Mmi_Solr_Client
 * @copyright  Copyright (c) 2011 Skylab Michał Oczkowski
 * @author     Michał Oczkowski <michal@e-oczkowski.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klient SOLR
 * @category   Mmi
 * @package    Mmi_Solr_Client
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Solr_Client {

	public $solrServerUrl = null;
	protected $_method = 'POST';
	protected $_header = 'Content-type: text/json';
	protected $_solrMethod = null;

	public function __construct($solrUrl) {
		$this->solrServerUrl = $solrUrl;
	}

	/**
	 * Wykonanie metody select na silniku solr
	 *
	 * @param Mmi_Solr_Query $queryObject
	 * @return String
	 */
	public function select(Mmi_Solr_Query $queryObject) {
		$this->_solrMethod = 'select';

		$opts = array(
			'http' => array('ignore_errors' => true)
		);

		$context = stream_context_create($opts);

		try {
			return file_get_contents($this->solrServerUrl . '/' . $this->_solrMethod . '?' . $queryObject->searchUrl(), false, $context);
		} catch (Exception $ex) {
			Mmi_Lib::dump($ex);
			die();
		}
	}

	/**
	 * Wykonanie insert na danych umieszczonych w solr
	 *
	 * @param stdClass $obj
	 * @param boolean $commit
	 * @throws Mmi_Solr_Exception
	 */
	public function insert(stdClass $obj, $commit = true) {
		$this->_solrMethod = 'update';

		$addObj = new stdClass();
		$addObj->add = new stdClass();
		$addObj->add->overwrite = true;
		$addObj->add->doc = $obj;

		$jsonObject = json_encode($addObj);

		$opts = array('http' =>
			array(
				'method' => 'POST',
				'header' => 'Content-type: text/json',
				'content' => $jsonObject,
				'ignore_errors' => true
			)
		);

		$context = stream_context_create($opts);

		try {
			$response = file_get_contents($this->solrServerUrl . '/' . $this->_solrMethod, false, $context);
			$responseObject = json_decode($response);
			if (!isset($responseObject->error) && $commit) {
				$this->commit();
			} elseif (isset($responseObject->error)) {
				$e = new Mmi_Solr_Exception($responseObject->error->msg, $responseObject->error->code);
				throw $e;
			}
		} catch (Exception $ex) {
			Mmi_Lib::dump($ex);
			die();
		}
	}

	/**
	 * Wykonanie insert większej ilości danych
	 * @param array $stdClassArray
	 */
	public function insertAll(array $stdClassArray) {
		foreach ($stdClassArray as $object) {
			if ($object instanceof stdClass) {
				$this->insert($object, false);
			}
		}
		$this->commit();
	}

	/**
	 * Metoda update danych umieszczonych w indeksie
	 * @param stdClass $obj
	 */
	public function update(stdClass $obj) {
		$this->insert($obj);
	}

	/**
	 * Usunięcie danych z indeksu
	 *
	 * @param integer $id
	 * @param boolean $commit
	 * @throws Mmi_Solr_Exception
	 */
	public function delete($id, $commit = true) {
		$this->_solrMethod = 'update';

		$addObj = new stdClass($id);
		$addObj->delete = new stdClass();
		$addObj->delete->id = $id;

		$jsonObject = json_encode($addObj);

		$opts = array('http' =>
			array(
				'method' => 'POST',
				'header' => 'Content-type: text/json',
				'content' => $jsonObject,
				'ignore_errors' => true
			)
		);

		$context = stream_context_create($opts);

		try {
			$response = file_get_contents($this->solrServerUrl . '/' . $this->_solrMethod, false, $context);
			$responseObject = json_decode($response);
			if (!isset($responseObject->error) & $commit) {
				$this->commit();
			} elseif(isset($responseObject->error)) {
				$e = new Mmi_Solr_Exception($responseObject->error->msg, $responseObject->error->code);
				throw $e;
			}
		} catch (Exception $ex) {
			Mmi_Lib::dump($ex);
			die();
		}
	}

	/**
	 * Wykonanie metody commit na indeksie silnika solr
	 * @return string
	 * @throws Mmi_Solr_Exception
	 */
	public function commit() {
		$this->_solrMethod = 'update';

		$opts = array('http' =>
			array(
				'method' => 'POST',
				'header' => 'Content-type: text/json',
				'ignore_errors' => true
			)
		);

		$context = stream_context_create($opts);

		try {
			$response = file_get_contents($this->solrServerUrl . '/' . $this->_solrMethod . '?commit=true', false, $context);
			$responseObject = json_decode($response);
			if (!isset($responseObject->error)) {
				return $response;
			} else {
				$e = new Mmi_Solr_Exception($responseObject->error->msg, $responseObject->error->code);
				throw $e;
			}
		} catch (Exception $ex) {
			Mmi_Lib::dump($ex);
			die();
		}
	}

}

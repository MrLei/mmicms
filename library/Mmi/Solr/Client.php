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
 * @package    \Mmi\Solr\Client
 * @copyright  Copyright (c) 2011 Skylab Michał Oczkowski
 * @author     Michał Oczkowski <michal@e-oczkowski.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klient SOLR
 * @category   Mmi
 * @package    \Mmi\Solr\Client
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Solr;

class Client {

	public $solrServerUrl = null;
	protected $_core = null;
	protected $_method = 'POST';
	protected $_header = 'Content-type: text/json';
	protected $_solrMethod = null;

	public function __construct($solrUrl, $core) {
		$this->solrServerUrl = $solrUrl;
		$this->_core = $core;
	}

	/**
	 * Metoda odpowiedzialna za reload danego indeksu w przypadku jeżeli zajdą zmiany
	 * w pliku solrconfig.xml lub schema.xml
	 * @return string
	 * @throws Exception
	 */
	public function reload() {
		$this->_solrMethod = 'cores';

		$opts = array(
			'http' => array('ignore_errors' => true)
		);

		$context = stream_context_create($opts);

		try {
			return file_get_contents($this->solrServerUrl . '/admin/' . $this->_solrMethod . '?wt=json&action=reload&core=' . $this->_core, false, $context);
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	/**
	 * Wykonanie metody select na silniku solr
	 *
	 * @param \Mmi\Solr\Query $queryObject
	 * @return String
	 */
	public function select(\Mmi\Solr\Query $queryObject) {
		$this->_solrMethod = 'select';

		$opts = array(
			'http' => array('ignore_errors' => true)
		);

		$context = stream_context_create($opts);

		try {
			return file_get_contents($this->solrServerUrl . '/' . $this->_core . '/' . $this->_solrMethod . '?' . $queryObject->searchUrl(), false, $context);
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	/**
	 * Wykonanie insert na danych umieszczonych w solr
	 *
	 * @param \stdClass $obj
	 * @param boolean $commit
	 * @throws \Mmi\Solr\Exception
	 */
	public function insert(\stdClass $obj, $commit = true) {
		$this->_solrMethod = 'update';

		$addObj = new \stdClass();
		$addObj->add = new \stdClass();
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
			$response = file_get_contents($this->solrServerUrl . '/' . $this->_core . '/' . $this->_solrMethod, false, $context);
			$responseObject = json_decode($response);
			if (!isset($responseObject->error) && $commit) {
				$this->commit();
			} elseif (isset($responseObject->error)) {
				$e = new \Mmi\Solr\Exception($responseObject->error->msg, $responseObject->error->code);
				throw $e;
			}
		} catch (Exception $ex) {
			\Mmi\Lib::dump($ex);
			die();
		}
	}

	/**
	 * Wykonanie insert większej ilości danych
	 * @param array $stdClassArray
	 */
	public function insertAll(array $stdClassArray) {
		foreach ($stdClassArray as $object) {
			if ($object instanceof \stdClass) {
				$this->insert($object, false);
			}
		}
		$this->commit();
	}

	/**
	 * Metoda update danych umieszczonych w indeksie
	 * @param \stdClass $obj
	 */
	public function update(\stdClass $obj) {
		$this->insert($obj);
	}

	/**
	 * Usunięcie danych z indeksu
	 *
	 * @param integer $id
	 * @param boolean $commit
	 * @throws \Mmi\Solr\Exception
	 */
	public function delete($id, $commit = true) {
		$this->_solrMethod = 'update';

		$addObj = new \stdClass($id);
		$addObj->delete = new \stdClass();
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
			$response = file_get_contents($this->solrServerUrl . '/' . $this->_core . '/' . $this->_solrMethod, false, $context);
			$responseObject = json_decode($response);
			if (!isset($responseObject->error) & $commit) {
				$this->commit();
			} elseif (isset($responseObject->error)) {
				$e = new \Mmi\Solr\Exception($responseObject->error->msg, $responseObject->error->code);
				throw $e;
			}
		} catch (Exception $ex) {
			\Mmi\Lib::dump($ex);
			die();
		}
	}

	/**
	 * Wykonanie metody commit na indeksie silnika solr
	 * @return string
	 * @throws \Mmi\Solr\Exception
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
			$response = file_get_contents($this->solrServerUrl . '/' . $this->_core . '/' . $this->_solrMethod . '?commit=true', false, $context);
			$responseObject = json_decode($response);
			if (!isset($responseObject->error)) {
				return $response;
			} else {
				$e = new \Mmi\Solr\Exception($responseObject->error->msg, $responseObject->error->code);
				throw $e;
			}
		} catch (Exception $ex) {
			\Mmi\Lib::dump($ex);
			die();
		}
	}

}

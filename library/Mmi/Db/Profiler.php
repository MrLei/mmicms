<?php
/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Db/Adapter/Profiler.php
 * @category   Mmi
 * @package    Mmi_Db
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa profilera bazodanowego
 * @category   Mmi
 * @package    Mmi_Db
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

class Mmi_Db_Profiler {

	/**
	 * Instancja
	 * @var Mmi_Db_Profiler
	 */
	private static $_instance;

	/**
	 * Dane zapytań
	 * @var array
	 */
	private $_data = array();

	/**
	 * Ilość zapytan
	 * @var int
	 */
	private $_numQueries = 0;

	/**
	 * Sumaryczny czas
	 * @var float
	 */
	private $_elapsed = 0;

	/**
	 * Pobiera instancję
	 * @return Mmi_Db_Profiler
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Dodaje zdarzenie
	 * @param string $query zapytanie
	 * @param int $elapsed czas wykonania
	 */
	public function event($query, $elapsed) {
		$this->_data[] = array('query' => $query, 'elapsed' => $elapsed);
		$this->_elapsed += $elapsed;
		$this->_numQueries++;
	}

	/**
	 * Pobiera ilość zapytań
	 * @return int
	 */
	public function getTotalNumQueries() {
		return $this->_numQueries;
	}

	/**
	 * Pobiera długość wszystkich zapytań
	 * @return int
	 */
	public function getTotalElapsedSecs() {
		return $this->_elapsed;
	}

	/**
	 * Pobiera dane o zapytaniach
	 * @return array
	 */
	public function getQueryProfiles() {
		return $this->_data;
	}

}

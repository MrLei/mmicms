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
 * Mmi/Solr/Query.php
 * @category   Mmi
 * @package    Mmi_Solr_Query
 * @copyright  Copyright (c) 2011 Skylab Michał Oczkowski
 * @author     Michał Oczkowski <michal@e-oczkowski.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klient SOLR
 * @category   Mmi
 * @package    Mmi_Solr_Query
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Solr_Query {

	private $_searchText = null;

	private $_offset = 0;

	private $_limit = null;

	private $_group = false;

	private $_groupField = null;

	private $_filterArray = array();

	private $_facet = false;

	private $_facetField = array();

	public function __construct() {

	}

	/**
	 * Ustawia szukaną frazę
	 * @param string $searchText
	 */
	public function where($searchText) {
		$this->_searchText = $searchText;
	}

	/**
	 * Limit pobranych danych
	 * @param int $limit
	 */
	public function setLimit($limit) {
		$this->_limit = $limit;
	}

	/**
	 * Offset
	 * @param int $offset
	 */
	public function setOffset($offset) {
		$this->_offset = $offset;
	}

	/**
	 * Grupowanie po danym polu
	 * @param string $fieldName
	 */
	public function groupBy($fieldName) {
		$this->_group = true;
		$this->_groupField = $fieldName;
	}

	/**
	 * Dodanie filtrów wyszukiwania
	 * @param string $filterField
	 * @param string $value
	 * @param string $operator (eq = , ge >=, el =<)
	 */
	public function addFilter($filterField, $value, $operator = 'eq') {
		$this->_filterArray[] = array('filterField' => $filterField, 'value' => $value, 'operator' => $operator);
	}

	/**
	 *
	 * @param string $filterField
	 * @param array $value
	 */
	public function addFilterIn($filterField, $value) {
		if(is_array($value)) {
			$this->addFilter($filterField, $value, 'in');
		}
	}

	/**
	 * Dodaje pola po których ma stworzyć fasety
	 * @param string $facetField
	 */
	public function addFacetField($facetField) {
		$this->_facet = true;
		$this->_facetField[] = $facetField;
	}

	/**
	 * Generuje url search dla solr
	 * @return string
	 */
	public function searchUrl() {
		$url = null;
		$url = 'q=*' . $this->_searchText . '*';

		foreach($this->_filterArray as $filter) {
			if($filter['operator'] == 'eq') {
				$url .= '&fq=' . $filter['filterField'] . ':' . $filter['value'];
			}
			if($filter['operator'] == 'ge') {
				$url .= '&fq=' . $filter['filterField'] . ':[' . $filter['value'] . ' TO *]';
			}
			if($filter['operator'] == 'el') {
				$url .= '&fq=' . $filter['filterField'] . ':[ * TO ' . $filter['value'] . ']';
			}
			if($filter['operator'] == 'in') {
				$url .= '&fq=' . $filter['filterField'] . ':(' . implode('+', $filter['value']) . ')';
			}
		}

		$url .= '&start=' . $this->_offset;

		if($this->_limit != null) {
			$url .= '&rows=' . $this->_limit;
		}

		if($this->_group) {
			$url .= '&group=true&group.field=' . $this->_groupField;
		}

		if($this->_facet) {
			$url .= '&facet=true';
			foreach($this->_facetField as $facetField) {
				$url .= '&facet.field=' . $facetField;
			}
		}

		$url .= '&wt=json';

		return $url;

	}

}

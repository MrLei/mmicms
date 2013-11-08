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
 * Mmi/Grid.php
 * @category   Mmi
 * @package    Mmi_Grid
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa data-grid
 * @category   Mmi
 * @package    Mmi_Grid
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class Mmi_Grid {

	/**
	 * Komunikaty
	 */
	const ON = 'Zaznaczony';
	const OFF = 'Odznaczony';
	const DELETE = 'Czy na pewno usunąć';
	const COUNTER = '#';

	/**
	 * Identyfikator grida
	 * @var string
	 */
	protected $_id;

	/**
	 * Nazwa DAO
	 * @var string
	 */
	protected $_daoName;

	/**
	 * Nazwa metody wywoływanej w DAO
	 * @var string
	 */
	protected $_daoGetMethod = 'find';

	/**
	 * Nazwa metoda zliczania w DAO
	 * @var string
	 */
	protected $_daoCountMethod = 'count';

	/**
	 * Przechowuje kolumny
	 * @var array
	 */
	protected $_columns;

	/**
	 * Przechowuje opcje
	 * @var array
	 */
	protected $_options;

	/**
	 * Referencja do widoku
	 * @var Mmi_View
	 */
	protected $_view;

	/**
	 * Referencja do żądania
	 * @var Mmi_Controller_Request
	 */
	protected $_request;

	/**
	 * Przechowuje dane
	 * @var array
	 */
	protected $_data;

	/**
	 * Przechowuje ilość rekordów
	 * @var int
	 */
	protected $_dataCount;

	/**
	 * Określa czy grid rozpoczął renderowanie
	 * @var boolean
	 */
	protected $_renderStarted;

	/**
	 * Konstruktor, ustawia wartości domyślne, referencje do obiektów i tworzy model
	 */
	public function __construct() {
		$this->_view = Mmi_View::getInstance();
		$this->_request = $this->_view->request;
		$this->_setDefaultOptions();
		$this->_view->headScript()->prependFile($this->_view->baseUrl . '/library/js/jquery/jquery.js');
		$this->_view->headScript()->appendFile($this->_view->baseUrl . '/library/js/grid.js');
		$class = get_class($this);
		$this->_id = strtolower(substr($class, strrpos($class, '_') + 1));

		if ($this->_daoName === null) {
			throw new exception('Dao name for grid not specified');
		}
		$this->init();
		$this->_renderStarted = false;
	}

	/**
	 * Renderer
	 * @return string
	 */
	public function __toString() {
		try {
			$data = $this->render();
		} catch (exception $e) {
			$data = 'Grid failed: ' . print_r($e, true);
		}
		return $data;
	}

	/**
	 * Zwraca identyfikator grid'a
	 * @return string
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * Abstrakcyjna funkcja użytkownika, do nadpisania przy tworzeniu nowego grida
	 */
	public abstract function init();

	/**
	 * Zwraca nazwę DAO
	 * @return string
	 */
	public function getDaoName() {
		return $this->_daoName;
	}

	/**
	 * Ustawia wszystkie opcje
	 * @param array $options opcje
	 * @return Mmi_Grid
	 */
	public function setOptions(array $options = array()) {
		foreach ($options as $key => $value) {
			$this->setOption($key, $value);
		}
		return $this;
	}

	/**
	 * Ustawia pojedynczą opcję
	 * @param string $name nazwa
	 * @param mixed $value wartość
	 * @return Mmi_Grid
	 */
	public function setOption($name, $value) {
		$this->_options[$name] = $value;
		$options = new Mmi_Session_Namespace(get_class($this));
		$options->options = $this->_options;
		return $this;
	}

	/**
	 * Dodaje kolumnę
	 * @param string $type typ: text|checkbox|select|custom
	 * @param string $name nazwa
	 * @param array $options opcje
	 * @return Mmi_Grid
	 */
	public function addColumn($type, $name, array $options = array()) {
		switch ($type) {
			case 'text':
				$options['class'] = 'text';
				break;
			case 'image':
				$options['class'] = 'image';
				$options['writeable'] = false;
				$options['sortable'] = false;
				$options['seekable'] = false;
				break;
			case 'checkbox':
				$options['class'] = 'checkbox';
				break;
			case 'select':
				$options['class'] = 'select';
				break;
			case 'custom':
				$options['class'] = 'custom';
				break;
			case 'buttons':
				$options['class'] = 'custom';
				$options['writeable'] = false;
				$options['sortable'] = false;
				$options['seekable'] = false;
				break;
			case 'counter':
				$options['label'] = self::COUNTER;
				$options['class'] = 'counter';
				$options['writeable'] = false;
				$options['sortable'] = false;
				break;
			default:
				throw new exception('Invalid type: "' . $type . '" passed as column type for: "' . $name . '"');
		}
		$options['type'] = $type;
		$options['translate'] = isset($options['translate']) ? $options['translate'] : true;
		$options['writeable'] = isset($options['writeable']) ? $options['writeable'] : true;
		$options['sortable'] = isset($options['sortable']) ? $options['sortable'] : true;
		$options['seekable'] = isset($options['seekable']) ? $options['seekable'] : true;
		$options['append'] = isset($options['append']) ? $options['append'] : true;
		$options['label'] = isset($options['label']) ? $options['label'] : $name;
		$options['name'] = $name;
		$options['links'] = isset($options['links']) ? $options['links'] : false;
		if ($options['append']) {
			$this->_columns[] = $options;
		} else {
			array_unshift($this->_columns, $options);
		}
		return $this;
	}

	/**
	 * Renderuje grid
	 * @return string
	 */
	public function render() {
		$html = '<form id="' . $this->_id . '"><table class="' . $this->_options['class'] . '">';
		$html .= $this->renderHead();
		$html .= '<tbody id="' . $this->_id . '_body">';
		$html .= $this->renderBody();
		$html .= '</tbody>';
		$html .= '</table></form>';
		return $html;
	}

	/**
	 * Renderuje ciało tabeli
	 * @return string
	 */
	public function renderBody() {
		if (!$this->_renderStarted) {
			$this->_setDefaultData();
			$this->_setDefaultColumns();
			$this->_renderStarted = true;
		}
		$html = '';
		$counter = ($this->_options['page'] - 1) * $this->_options['rows'] + 1;
		foreach ($this->_data as $rowData) {
			$html .= $this->_buildColumns($rowData, $counter++);
		}
		if (count($this->_data) < 1) {
			$html .= '<tr><td class="empty" colspan="' . count($this->_columns) . '">' . $this->_view->getTranslate()->_('Nie odnaleziono wyników') . '</td></tr>';
		}
		$html .= $this->renderPaging();
		$html .= '<tr style="display: none;"><td><input type="hidden" id="' . $this->_id . '__ctrl" value="' . Mmi_Lib::hashTable($this->_options) . '" />';
		$html .= '<input type="hidden" id="' . $this->_id . '__counter" value="' . ceil($this->_dataCount / $this->_options['rows']) . '" /></td></tr>';
		return $html;
	}

	/**
	 * Renderuje stronnicowanie (ilość elementów na stronie)
	 * @return string
	 */
	public function renderPaging() {
		$html = '<tr><th class="footer" colspan="' . count($this->_columns) . '">';

		$html .= $this->_view->getTranslate()->_('Strona') . ': ';
		$html .= '<select id="' . $this->_id . '-filter-counter" class="grid-spot" style="width: 65px;">';
		foreach ($this->_getPagesCount() as $page => $label) {
			$html .= '<option value="' . $page . '"' . (($this->_options['page'] == $page) ? ' selected="selected"' : '') . '>' . $label . '</option>';
		}
		$html .= '</select>';
		$html .= ' ' . $this->_view->getTranslate()->_('ilość wierszy na stronie') . ': ';
		$html .= '<select id="' . $this->_id . '-filter-setRowsPerPage" class="grid-spot" style="width: 65px;">';
		$html .= '<option value="10"' . (($this->_options['rows'] == 10) ? ' selected="selected"' : '') . '>10</option>';
		$html .= '<option value="20"' . (($this->_options['rows'] == 20) ? ' selected="selected"' : '') . '>20</option>';
		$html .= '<option value="50"' . (($this->_options['rows'] == 50) ? ' selected="selected"' : '') . '>50</option>';
		$html .= '<option value="100"' . (($this->_options['rows'] == 100) ? ' selected="selected"' : '') . '>100</option>';
		$html .= '<option value="1000"' . (($this->_options['rows'] == 1000) ? ' selected="selected"' : '') . '>1000</option>';
		$html .= '</select>';
		$html .= '</th></tr>';
		return $html;
	}

	/**
	 * Renderuje nagłówki tabeli
	 * @return string
	 */
	public function renderHead() {
		if (!$this->_renderStarted) {
			$this->_setDefaultData();
			$this->_setDefaultColumns();
			$this->_renderStarted = true;
		}
		$html = '<tr>';
		foreach ($this->_columns as $column) {
			$sort = '';
			if (isset($this->_options['order'][$column['name']])) {
				$sort = ' ' . strtolower($this->_options['order'][$column['name']]);
			}
			if ($this->_view->getTranslate() !== null && $column['translate']) {
				if ($column['translate'] && $column['label'] != '' && $column['label'] != '#') {
					$column['label'] = $this->_view->getTranslate()->_($column['label']);
				}
			}
			if (isset($column['sort']) && $column['sort']) {
				$name = $column['sort'];
			} else {
				$name = $column['name'];
			}
			$id = 'id="' . $this->_id . '-order-' . $name . '"';
			$html .= '<th class="' . $column['class'] . '">';
			$html .= '<div>';
			if ($column['sortable'] || (isset($column['sort']) && $column['sort'])) {
				$html .= '<a href="#' . $column['name'] . '" class="grid-spot' . $sort . '" ' . $id . '>' . $column['label'] . '</a>';
			} else {
				$html .= $column['label'];
			}
			$html .= '</div>';
			if ($column['seekable']) {
				$html .= $this->_buildHeadInput($column);
			}
			$html .= '</th>';
		}
		$html .= '</tr>';
		return $html;
	}

	/**
	 * Renderuje pole filtra w nagłówku dla danej kolumny
	 * @param array $column tabela z własnościami kolumny
	 * @return string
	 */
	protected function _buildHeadInput(array $column) {
		$html = '';
		$value = '';
		if (isset($this->_options['filter'][$column['name']])) {
			$value = (string) $this->_options['filter'][$column['name']];
		}
		$selected = '';

		$id = 'id="' . $this->_id . '-filter-' . $column['name'] . '"';
		switch ($column['type']) {
			case 'text':
			case 'custom':
				if (isset($column['multiOptions']) && is_array($column['multiOptions'])) {
					$html = '<select class="grid-spot" ' . $id . '>';
					$html .= '<option value="">---</option>';
					foreach ($column['multiOptions'] as $optionValue => $optionName) {
						($value !== (string) $optionValue) ? $selected = '' : $selected = ' selected="selected"';
						$html .= '<option value="' . $optionValue . '"' . $selected . '>' . $optionName . '</option>';
					}
					$html .= '</select>';
				} else {
					$html = '<input class="grid-spot" type="text" ' . $id . ' value="' . htmlentities($value) . '"/>';
				}
				break;
			case 'checkbox':
				$on = self::ON;
				$off = self::OFF;
				if ($this->_view->getTranslate() !== null) {
					$on = $this->_view->getTranslate()->_($on);
					$off = $this->_view->getTranslate()->_($off);
				}
				$html = '<select class="grid-spot" ' . $id . '>';
				$html .= '<option value="">---</option>';
				($value !== '1') ? $selected = '' : $selected = ' selected="selected"';
				$html .= '<option value="1"' . $selected . '>' . $on . '</option>';
				($value !== '0') ? $selected = '' : $selected = ' selected="selected"';
				$html .= '<option value="0"' . $selected . '>' . $off . '</option>';
				$html .= '</select>';
				break;
			case 'counter':
				break;
			case 'select':
				if (isset($column['multiOptions']) && is_array($column['multiOptions'])) {
					$html = '<select class="grid-spot" ' . $id . '>';
					if ($column['type'] == 'select') {
						$html .= '<option value="">---</option>';
					}
					foreach ($column['multiOptions'] as $optionValue => $optionName) {
						($value !== (string) $optionValue) ? $selected = '' : $selected = ' selected="selected"';
						$html .= '<option value="' . $optionValue . '"' . $selected . '>' . $optionName . '</option>';
					}
					$html .= '</select>';
				}
				break;
		}
		return $html;
	}

	/**
	 * Renderuje kolumny
	 * @param Mmi_Dao_Collection $rowData kolekcja modeli reprezentujących wiersze
	 * @param int $counter licznik
	 * @return string
	 */
	protected function _buildColumns($rowData, $counter) {
		$html = '<tr class="unhover">';

		foreach ($this->_columns as $column) {
			$filters = isset($column['filters']) ? $column['filters'] : array();
			$html .= '<td class="' . $column['type'] . '">';
			if ($column['type'] != 'buttons' && $column['type'] != 'counter') {
				$id = 'id="' . $this->_id . '-field-' . $column['type'] . '-' . $column['name'] . '-' . $rowData->id . '"';
				switch ($column['type']) {
					case 'text':
						$data = $this->_applyFilters($filters, strip_tags($rowData->$column['name']));
						if (strlen($data) > 128) {
							$data = mb_substr($data, 0, 125, 'utf-8') . '...';
						}
						if ($column['writeable'] && !$this->_options['locked']) {
							$html .= '<a href="#" ' . $id . ' class="grid-field-trigger">' . ($data ? $data : '&nbsp;') . '</a>';
						} else {
							$html .= '<div>' . $data . '</div>';
						}
						break;
					case 'image':
						$image = $rowData->$column['name'];
						if ($image instanceof Cms_Model_File_Record) {
							$column['scale'] = (isset($column['scale']) && intval(isset($column['scale'])) > 0) ? $column['scale'] : 200;
							$column['scaleType'] = (isset($column['scaleType'])) ? $column['scaleType'] : 'scalex';
							$html .= '<div><img class="image" src="' . $this->_view->thumb($image, $column['scaleType'], $column['scale']) . '" alt="' . $column['name'] . '" /></div>';
						}
						break;
					case 'select':
						if ($column['writeable'] && !$this->_options['locked']) {
							$html .= '<select ' . $id . ' class="grid-field">';
							foreach ($column['multiOptions'] as $key => $value) {
								if ($key == $rowData->$column['name']) {
									$selected = ' selected="selected"';
								} else {
									$selected = '';
								}
								$html .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
							}
							$html .= '</select>';
						} else {
							if (isset($column['multiOptions']['false'])) {
								$column['multiOptions'][0] = $column['multiOptions']['false'];
							}
							if (isset($column['multiOptions']['true'])) {
								$column['multiOptions'][1] = $column['multiOptions']['true'];
							}
							$value = isset($column['multiOptions'][$rowData->$column['name']]) ? $column['multiOptions'][$rowData->$column['name']] : $rowData->$column['name'];
							$html .= '<div>' . $value . '</div>';
						}
						break;
					case 'checkbox':
						$checked = $rowData->$column['name'] == 1 ? ' checked=""' : '';
						if ($column['writeable'] && !$this->_options['locked']) {
							$html .= '<input type="checkbox" ' . $id . ' value="1" class="grid-field"' . $checked . '>';
						} else {
							$html .= '<input disabled="disabled" type="checkbox" ' . $id . $checked . '>';
						}
						break;
					case 'custom':
						$GLOBALS['rowData'] = $rowData;
						$column['value'] = preg_replace_callback('/%([a-zA-Z0-9_]+)%/', create_function(
								'$matches', 'return $GLOBALS[\'rowData\']->$matches[1];'
							), $column['value']);
						$this->_view->rowData = $rowData;
						$this->_view->column = $column;
						$html .= $this->_view->renderDirectly($column['value']);
						break;
				}
			} elseif ($column['type'] == 'buttons') {
				$value = '';
				if (isset($column['links']) && is_array($column['links']) && array_key_exists('edit', $column['links'])) {
					$linkEdit = $column['links']['edit'];
				} else {
					$linkEdit = $this->_options['links']['edit'];
				}
				if (null !== $linkEdit) {
					$value .= '<a href="' . $linkEdit . '"><img src="' . Mmi_View::getInstance()->baseUrl . '/default/cms/images/ico16_edit.gif" /></a>';
				}
				if (isset($column['links']) && is_array($column['links']) && array_key_exists('delete', $column['links'])) {
					$linkDelete = $column['links']['delete'];
				} else {
					$linkDelete = $this->_options['links']['delete'];
				}

				if (null !== $linkDelete) {
					$confirmDelete = self::DELETE;
					if ($this->_view->getTranslate() !== null) {
						$confirmDelete = $this->_view->getTranslate()->_(self::DELETE);
					}
					$value .= '<a title="' . $confirmDelete . '" class="confirm" href="' . $linkDelete . '"><img src="' . Mmi_View::getInstance()->baseUrl . '/default/cms/images/ico16_remove.gif" /></a>';
				}
				foreach ($rowData->toArray() as $fieldName => $fieldValue) {
					if (is_string($fieldValue) || is_int($fieldValue)) {
						$value = str_replace('%' . $fieldName . '%', $fieldValue, $value);
					}
				}
				$html .= $value;
			} elseif ($column['type'] == 'counter') {
				$html .= '<div>' . $counter . '</div>';
			}
			$html .= '</td>';
		}
		$html .= '</tr>';
		return $html;
	}

	/**
	 * Ustawia domyślne opcje
	 */
	protected function _setDefaultOptions() {
		$this->_columns = array();
		if ($this->_request->run != '') {
			$links = array(
				'edit' => $this->_view->url(array('id' => '%id%', 'run' => 'edit')),
				'delete' => $this->_view->url(array('id' => '%id%', 'run' => 'delete')),
			);
		} else {
			$links = array(
				'edit' => $this->_view->url(array('id' => '%id%', 'action' => 'edit')),
				'delete' => $this->_view->url(array('id' => '%id%', 'action' => 'delete')),
			);
		}
		$options = new Mmi_Session_Namespace(get_class($this));
		if (!empty($options->options)) {
			$this->_options = $options->options;
		} else {
			$this->_options = array(
				'className' => get_class($this),
				'links' => $links,
				'class' => 'grid',
				'locked' => true,
				'filter' => array(),
				'order' => array(),
				'page' => '1',
				'rows' => '20',
			);
		}
	}

	/**
	 * Ustawia dane dla grid'a
	 */
	protected function _setDefaultData() {
		$bind = array();
		$order = array();
		foreach ($this->_options['filter'] as $field => $value) {
			$type = 'text';
			foreach ($this->_columns as $column) {
				if ($column['name'] == $field) {
					$type = $column['type'];
					break;
				}
			}
			if ($type == 'select' || $type == 'checkbox') {
				$bind = array($bind, array($field, '' . $value, '='));
			} else {
				$bind = array($bind, array($field, '%' . $value . '%', 'LIKE'));
			}
		}
		if (empty($this->_options['order'])) {
			//@TODO: do zmiany po rozwinięciu DAO
			$order = array('id', 'ASC');
		}
		foreach ($this->_options['order'] as $field => $value) {
			$order = array($field, $value);
		}
		if (isset($this->_options['bind'])) {
			foreach ($this->_options['bind'] as $field => $value) {
				$bind = array($bind, array($value[0], $value[1], $value[2]));
			}
		}

		$dao = $this->_daoName;
		$get = $this->_daoGetMethod;
		$count = $this->_daoCountMethod;
		$this->_dataCount = $dao::$count($bind);
		$this->_data = $dao::$get($bind, $order, $this->_options['rows'], ($this->_options['page'] - 1) * $this->_options['rows']);
	}

	/**
	 * Ustawia obowiązkowe kolumny (licznik)
	 */
	protected function _setDefaultColumns() {
		$this->addColumn('counter', 'counter', array('append' => false));
	}

	/**
	 * Zwraca ilość stron
	 * @return int
	 */
	protected function _getPagesCount() {
		$pages = array();
		for ($i = 1; $i <= ceil($this->_dataCount / $this->_options['rows']); $i++) {
			$pages[$i] = $i;
		}
		return $pages;
	}

	/**
	 * Zastosowanie filtrów na danaj zmiennej
	 * @param array $filters lista filtrów do zaaplikowania
	 * @param string $value wartość do przerobienia
	 * @return string
	 */
	protected function _applyFilters($filters, $value) {
		if (empty($filters)) {
			return $value;
		}
		foreach ($filters as $filter) {
			$params = explode(':', $filter);
			$filterName = $params[0];
			array_shift($params);
			$filter = $this->_getFilter($filterName);
			if (!empty($params)) {
				$filter->setOptions($params);
			}
			$value = $filter->filter($value);
		}
		return $value;
	}

	/**
	 * Pobiera obiekt filtra
	 * @param string $name nazwa filtra
	 * @return Mmi_Filter_Interface
	 */
	protected final function _getFilter($name) {
		$name = ucfirst($name);
		$className = 'Mmi_Filter_' . $name;
		if (isset($this->_filters[$className])) {
			return $this->_filters[$className];
		}
		$filter = new $className();
		$this->_filters[$className] = $filter;
		return $filter;
	}

}
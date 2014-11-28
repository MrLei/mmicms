<?php

/**
 * @method Cms_Model_Container_Template_Query limit() limit($limit = null)
 * @method Cms_Model_Container_Template_Query offset() offset($offset = null)
 * @method Cms_Model_Container_Template_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Query resetOrder() resetOrder()
 * @method Cms_Model_Container_Template_Query resetWhere() resetWhere()
 */
class Cms_Model_Container_Template_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function wherePath() {
		return $this->where('path');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function andFieldPath() {
		return $this->andField('path');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orFieldPath() {
		return $this->orField('path');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orderAscPath() {
		return $this->orderAsc('path');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orderDescPath() {
		return $this->orderDesc('path');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return Cms_Model_Container_Template_Query_Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Container_Template_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Container_Template_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}
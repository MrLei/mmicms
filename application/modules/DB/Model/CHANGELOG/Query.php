<?php

/**
 * @method DB_Model_CHANGELOG_Query limit() limit($limit = null)
 * @method DB_Model_CHANGELOG_Query offset() offset($offset = null)
 * @method DB_Model_CHANGELOG_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method DB_Model_CHANGELOG_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method DB_Model_CHANGELOG_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method DB_Model_CHANGELOG_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method DB_Model_CHANGELOG_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method DB_Model_CHANGELOG_Query andField() andField($fieldName, $tableName = null)
 * @method DB_Model_CHANGELOG_Query where() where($fieldName, $tableName = null)
 * @method DB_Model_CHANGELOG_Query orField() orField($fieldName, $tableName = null)
 * @method DB_Model_CHANGELOG_Query resetOrder() resetOrder()
 * @method DB_Model_CHANGELOG_Query resetWhere() resetWhere()
 */
class DB_Model_CHANGELOG_Query extends Mmi_Dao_Query {

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function whereFilename() {
		return $this->where('filename');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function andFieldFilename() {
		return $this->andField('filename');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function orFieldFilename() {
		return $this->orField('filename');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function orderAscFilename() {
		return $this->orderAsc('filename');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function orderDescFilename() {
		return $this->orderDesc('filename');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function whereMd5() {
		return $this->where('md5');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function andFieldMd5() {
		return $this->andField('md5');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function orFieldMd5() {
		return $this->orField('md5');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function orderAscMd5() {
		return $this->orderAsc('md5');
	}

	/**
	 * @return DB_Model_CHANGELOG_Query_Field
	 */
	public function orderDescMd5() {
		return $this->orderDesc('md5');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return DB_Model_CHANGELOG_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return DB_Model_CHANGELOG_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}
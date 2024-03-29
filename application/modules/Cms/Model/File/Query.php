<?php

/**
 * @method Cms_Model_File_Query limit() limit($limit = null)
 * @method Cms_Model_File_Query offset() offset($offset = null)
 * @method Cms_Model_File_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_File_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_File_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_File_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_File_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_File_Query resetOrder() resetOrder()
 * @method Cms_Model_File_Query resetWhere() resetWhere()
 * @method Cms_Model_File_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_File_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_File_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_File_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_File_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_File_Record[] find() find()
 * @method Cms_Model_File_Record findFirst() findFirst()
 */
class Cms_Model_File_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_File_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereClass() {
		return $this->where('class');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldClass() {
		return $this->andField('class');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldClass() {
		return $this->orField('class');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscClass() {
		return $this->orderAsc('class');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescClass() {
		return $this->orderDesc('class');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereMimeType() {
		return $this->where('mimeType');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldMimeType() {
		return $this->andField('mimeType');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldMimeType() {
		return $this->orField('mimeType');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscMimeType() {
		return $this->orderAsc('mimeType');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescMimeType() {
		return $this->orderDesc('mimeType');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereOriginal() {
		return $this->where('original');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldOriginal() {
		return $this->andField('original');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldOriginal() {
		return $this->orField('original');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscOriginal() {
		return $this->orderAsc('original');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescOriginal() {
		return $this->orderDesc('original');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereAuthor() {
		return $this->where('author');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldAuthor() {
		return $this->andField('author');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldAuthor() {
		return $this->orField('author');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscAuthor() {
		return $this->orderAsc('author');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescAuthor() {
		return $this->orderDesc('author');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereSource() {
		return $this->where('source');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldSource() {
		return $this->andField('source');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldSource() {
		return $this->orField('source');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscSource() {
		return $this->orderAsc('source');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescSource() {
		return $this->orderDesc('source');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereSize() {
		return $this->where('size');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldSize() {
		return $this->andField('size');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldSize() {
		return $this->orField('size');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscSize() {
		return $this->orderAsc('size');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescSize() {
		return $this->orderDesc('size');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereOrder() {
		return $this->where('order');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldOrder() {
		return $this->andField('order');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldOrder() {
		return $this->orField('order');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscOrder() {
		return $this->orderAsc('order');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescOrder() {
		return $this->orderDesc('order');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereSticky() {
		return $this->where('sticky');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldSticky() {
		return $this->andField('sticky');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldSticky() {
		return $this->orField('sticky');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscSticky() {
		return $this->orderAsc('sticky');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescSticky() {
		return $this->orderDesc('sticky');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_File_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}
<?php

/**
 * @method \Cms\Model\File\Query limit() limit($limit = null)
 * @method \Cms\Model\File\Query offset() offset($offset = null)
 * @method \Cms\Model\File\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\File\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\File\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\File\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\File\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\File\Query resetOrder() resetOrder()
 * @method \Cms\Model\File\Query resetWhere() resetWhere()
 * @method \Cms\Model\File\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\File\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\File\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\File\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\File\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\File\Record[] find() find()
 * @method \Cms\Model\File\Record findFirst() findFirst()
 */

namespace Cms\Model\File;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\File\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereClass() {
		return $this->where('class');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldClass() {
		return $this->andField('class');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldClass() {
		return $this->orField('class');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscClass() {
		return $this->orderAsc('class');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescClass() {
		return $this->orderDesc('class');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereMimeType() {
		return $this->where('mimeType');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldMimeType() {
		return $this->andField('mimeType');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldMimeType() {
		return $this->orField('mimeType');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscMimeType() {
		return $this->orderAsc('mimeType');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescMimeType() {
		return $this->orderDesc('mimeType');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereOriginal() {
		return $this->where('original');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldOriginal() {
		return $this->andField('original');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldOriginal() {
		return $this->orField('original');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscOriginal() {
		return $this->orderAsc('original');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescOriginal() {
		return $this->orderDesc('original');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereAuthor() {
		return $this->where('author');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldAuthor() {
		return $this->andField('author');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldAuthor() {
		return $this->orField('author');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscAuthor() {
		return $this->orderAsc('author');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescAuthor() {
		return $this->orderDesc('author');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereSource() {
		return $this->where('source');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldSource() {
		return $this->andField('source');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldSource() {
		return $this->orField('source');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscSource() {
		return $this->orderAsc('source');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescSource() {
		return $this->orderDesc('source');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereSize() {
		return $this->where('size');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldSize() {
		return $this->andField('size');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldSize() {
		return $this->orField('size');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscSize() {
		return $this->orderAsc('size');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescSize() {
		return $this->orderDesc('size');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereOrder() {
		return $this->where('order');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldOrder() {
		return $this->andField('order');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldOrder() {
		return $this->orField('order');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscOrder() {
		return $this->orderAsc('order');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescOrder() {
		return $this->orderDesc('order');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereSticky() {
		return $this->where('sticky');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldSticky() {
		return $this->andField('sticky');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldSticky() {
		return $this->orField('sticky');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscSticky() {
		return $this->orderAsc('sticky');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescSticky() {
		return $this->orderDesc('sticky');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return \Cms\Model\File\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}
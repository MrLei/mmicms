<?php

namespace Cms\Model\Mail;

/**
 * @method \Cms\Model\Mail\Query limit($limit = null)
 * @method \Cms\Model\Mail\Query offset($offset = null)
 * @method \Cms\Model\Mail\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Mail\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Mail\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Mail\Query resetOrder()
 * @method \Cms\Model\Mail\Query resetWhere()
 * @method \Cms\Model\Mail\Query\Field whereId()
 * @method \Cms\Model\Mail\Query\Field andFieldId()
 * @method \Cms\Model\Mail\Query\Field orFieldId()
 * @method \Cms\Model\Mail\Query\Field orderAscId()
 * @method \Cms\Model\Mail\Query\Field orderDescId()
 * @method \Cms\Model\Mail\Query\Field whereCmsMailDefinitionId()
 * @method \Cms\Model\Mail\Query\Field andFieldCmsMailDefinitionId()
 * @method \Cms\Model\Mail\Query\Field orFieldCmsMailDefinitionId()
 * @method \Cms\Model\Mail\Query\Field orderAscCmsMailDefinitionId()
 * @method \Cms\Model\Mail\Query\Field orderDescCmsMailDefinitionId()
 * @method \Cms\Model\Mail\Query\Field whereFromName()
 * @method \Cms\Model\Mail\Query\Field andFieldFromName()
 * @method \Cms\Model\Mail\Query\Field orFieldFromName()
 * @method \Cms\Model\Mail\Query\Field orderAscFromName()
 * @method \Cms\Model\Mail\Query\Field orderDescFromName()
 * @method \Cms\Model\Mail\Query\Field whereTo()
 * @method \Cms\Model\Mail\Query\Field andFieldTo()
 * @method \Cms\Model\Mail\Query\Field orFieldTo()
 * @method \Cms\Model\Mail\Query\Field orderAscTo()
 * @method \Cms\Model\Mail\Query\Field orderDescTo()
 * @method \Cms\Model\Mail\Query\Field whereReplyTo()
 * @method \Cms\Model\Mail\Query\Field andFieldReplyTo()
 * @method \Cms\Model\Mail\Query\Field orFieldReplyTo()
 * @method \Cms\Model\Mail\Query\Field orderAscReplyTo()
 * @method \Cms\Model\Mail\Query\Field orderDescReplyTo()
 * @method \Cms\Model\Mail\Query\Field whereSubject()
 * @method \Cms\Model\Mail\Query\Field andFieldSubject()
 * @method \Cms\Model\Mail\Query\Field orFieldSubject()
 * @method \Cms\Model\Mail\Query\Field orderAscSubject()
 * @method \Cms\Model\Mail\Query\Field orderDescSubject()
 * @method \Cms\Model\Mail\Query\Field whereMessage()
 * @method \Cms\Model\Mail\Query\Field andFieldMessage()
 * @method \Cms\Model\Mail\Query\Field orFieldMessage()
 * @method \Cms\Model\Mail\Query\Field orderAscMessage()
 * @method \Cms\Model\Mail\Query\Field orderDescMessage()
 * @method \Cms\Model\Mail\Query\Field whereAttachements()
 * @method \Cms\Model\Mail\Query\Field andFieldAttachements()
 * @method \Cms\Model\Mail\Query\Field orFieldAttachements()
 * @method \Cms\Model\Mail\Query\Field orderAscAttachements()
 * @method \Cms\Model\Mail\Query\Field orderDescAttachements()
 * @method \Cms\Model\Mail\Query\Field whereType()
 * @method \Cms\Model\Mail\Query\Field andFieldType()
 * @method \Cms\Model\Mail\Query\Field orFieldType()
 * @method \Cms\Model\Mail\Query\Field orderAscType()
 * @method \Cms\Model\Mail\Query\Field orderDescType()
 * @method \Cms\Model\Mail\Query\Field whereDateAdd()
 * @method \Cms\Model\Mail\Query\Field andFieldDateAdd()
 * @method \Cms\Model\Mail\Query\Field orFieldDateAdd()
 * @method \Cms\Model\Mail\Query\Field orderAscDateAdd()
 * @method \Cms\Model\Mail\Query\Field orderDescDateAdd()
 * @method \Cms\Model\Mail\Query\Field whereDateSent()
 * @method \Cms\Model\Mail\Query\Field andFieldDateSent()
 * @method \Cms\Model\Mail\Query\Field orFieldDateSent()
 * @method \Cms\Model\Mail\Query\Field orderAscDateSent()
 * @method \Cms\Model\Mail\Query\Field orderDescDateSent()
 * @method \Cms\Model\Mail\Query\Field whereDateSendAfter()
 * @method \Cms\Model\Mail\Query\Field andFieldDateSendAfter()
 * @method \Cms\Model\Mail\Query\Field orFieldDateSendAfter()
 * @method \Cms\Model\Mail\Query\Field orderAscDateSendAfter()
 * @method \Cms\Model\Mail\Query\Field orderDescDateSendAfter()
 * @method \Cms\Model\Mail\Query\Field whereActive()
 * @method \Cms\Model\Mail\Query\Field andFieldActive()
 * @method \Cms\Model\Mail\Query\Field orFieldActive()
 * @method \Cms\Model\Mail\Query\Field orderAscActive()
 * @method \Cms\Model\Mail\Query\Field orderDescActive()
 * @method \Cms\Model\Mail\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Mail\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Mail\Record[] find()
 * @method \Cms\Model\Mail\Record findFirst()
 * @method \Cms\Model\Mail\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Mail\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}

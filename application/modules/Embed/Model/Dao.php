<?php

class Embed_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'embed';

	public static function findFirstActiveByDomainIdContentId($domainId, $contentId) {
		$q = self::newQuery()
			->where('embed_domain_id')->equals($domainId)
			->andField('encodedId')->equals($contentId)
			->andField('active')->equals(1);

		return self::findFirst($q);
	}

}
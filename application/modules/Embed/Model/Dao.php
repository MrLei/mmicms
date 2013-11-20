<?php

class Embed_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'embed';

	public static function findFirstActiveByDomainIdContentId($domainId, $contentId) {
		$q = self::newQuery()
			->where('embed_domain_id')->eqals($domainId)
			->andField('encodedId')->eqals($contentId)
			->andField('active')->eqals(1);

		return self::findFirst($q);
	}

}
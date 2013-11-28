<?php

/**
 * @property integer $id
 * @property string $lang
 * @property string $key
 * @property string $content
 * @property string $dateModify
 */
class Cms_Model_Text_Record extends Mmi_Dao_Record {

	public function save() {
		$this->dateModify = date('Y-m-d H:i:s');
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		foreach (glob(TMP_PATH . '/compile/' . $this->lang . '_*.php') as $compilant) {
			unlink($compilant);
		}
		$result = parent::save();
		Default_Registry::$cache->remove('Cms_Text');
		return $result;
	}

}
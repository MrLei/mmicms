<?php

class Cms_Model_Text_Record extends Mmi_Dao_Record {

	public $id;
	public $lang;
	public $key;
	public $content;
	public $dateModify;

	public function save() {
		$this->dateModify = date('Y-m-d H:i:s');
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		foreach (glob(TMP_PATH . '/compile/' . $this->lang . '_*.php') as $compilant) {
			unlink($compilant);
		}
		try {
			$result = parent::save();
		} catch (Exception $e) {
			//duplikat
			return false;
		}
		Default_Registry::$cache->remove('Cms_Text');
		return $result;
	}

	public function cloneKeys() {
		$lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		foreach (Cms_Model_Text_Dao::byLangQuery($this->source)->find() as $record) {/* @var $record Cms_Model_Text_Record */
			if (Cms_Model_Text_Dao::byKeyLangQuery($record->key, $lang)->findFirst() !== null) {
				continue;
			}
			$r = new self();
			$r->lang = $lang;
			$r->key = $record->key;
			$r->content = $record->content;
			$r->save();
		}
		return true;
	}

}

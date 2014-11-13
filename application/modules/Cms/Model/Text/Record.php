<?php

class Cms_Model_Text_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $lang;

	/**
	 *
	 * @var string
	 */
	public $key;

	/**
	 *
	 * @var string
	 */
	public $content;

	/**
	 *
	 * @var string
	 */
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
		foreach (Cms_Model_Text_Dao::findByLang($this->source) as $record) {/* @var $record Cms_Model_Text_Record */
			if (Cms_Model_Text_Dao::findFirstByKeyLang($record->key, $lang) !== null) {
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

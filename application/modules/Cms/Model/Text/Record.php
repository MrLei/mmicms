<?php


namespace Cms\Model\Text;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $lang;
	public $key;
	public $content;
	public $dateModify;

	public function save() {
		$this->dateModify = date('Y-m-d H:i:s');
		$this->lang = \Mmi\Controller\Front::getInstance()->getRequest()->lang;
		foreach (glob(TMP_PATH . '/compile/' . $this->lang . '_*.php') as $compilant) {
			unlink($compilant);
		}
		try {
			$result = parent::save();
		} catch (Exception $e) {
			//duplikat
			return false;
		}
		Core\Registry::$cache->remove('Cms\Text');
		return $result;
	}

	public function cloneKeys() {
		$lang = \Mmi\Controller\Front::getInstance()->getRequest()->lang;
		foreach (Cms\Model\Text\Dao::byLangQuery($this->source)->find() as $record) {/* @var $record Cms\Model\Text\Record */
			if (Cms\Model\Text\Dao::byKeyLangQuery($record->key, $lang)->findFirst() !== null) {
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

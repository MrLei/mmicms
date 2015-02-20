<?php

namespace Cms\Plugin;
class TextGrid extends \Mmi\Grid {

	public function init() {
		
		$this->setQuery(Cms\Model\Text\Dao::langQuery()
			->orderAscKey());

		$this->setOption('rows', 100);

		$this->addColumn('text', 'lang', array(
			'label' => 'język'
		));

		$this->addColumn('text', 'key', array(
			'label' => 'klucz',
		));

		$this->addColumn('text', 'content', array(
			'label' => 'treść',
			'sortable' => false,
			'seekable' => false
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'data modyfikacji',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}

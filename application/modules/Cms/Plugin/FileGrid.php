<?php

class Cms_Plugin_FileGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_File_Dao';

	public function init() {

		$this->addColumn('custom', 'thumb', array(
			'label' => 'miniatura',
			'value' => '{if ($rowData->class ==\'image\')}<img src="{thumb($rowData, \'scaley\', \'30\')}" />{else}-{/if}'
		));

		$this->addColumn('text', 'size', array(
			'label' => 'rozmiar',
			'writeable' => false
			)
		);

		$this->addColumn('text', 'original', array(
			'label' => 'nazwa pliku',
			'writeable' => true
			)
		);

		$this->addColumn('text', 'title', array(
			'label' => 'tytuł',
			'writeable' => true
			)
		);

		$this->addColumn('text', 'author', array(
			'label' => 'autor',
			'writeable' => true
			)
		);

		$this->addColumn('text', 'source', array(
			'label' => 'źródło',
			'writeable' => true
			)
		);

		$this->addColumn('text', 'username', array(
			'label' => 'właściciel',
			'writeable' => false
			)
		);

		$this->addColumn('text', 'object', array(
			'label' => 'zasób'
			)
		);

		$this->addColumn('text', 'objectId', array(
			'label' => 'id zasobu'
			)
		);

		$this->addColumn('checkbox', 'active', array(
			'label' => 'widoczny',
			'writeable' => true
			)
		);

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			'links' => array(
				'edit' => null,
				'delete' => $this->_view->url(array('module' => 'cms', 'controller' => 'adminFile', 'id' => '%id%', 'action' => 'remove'), true),
			)
		));
	}

}

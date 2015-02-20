<?php

namespace Cms\Plugin;
class FileGrid extends \Mmi\Grid {

	public function init() {
		
		$this->setQuery(Cms\Model\File\Query::factory());

		$this->addColumn('custom', 'thumb', array(
			'label' => 'miniatura',
			'value' => '{if ($rowData->class ==\'image\')}<img src="{thumb($rowData, \'scaley\', \'30\')}" />{else}'.
				'{$mime = \'%mimeType%\'}'.
				'{if $mime == \'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/xlsx-32.png" alt="Microsoft Office - OOXML - Spreadsheet" />'.
				'{elseif $mime == \'application/vnd.ms-excel\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/xls-32.png" alt="Microsoft Excel Sheet File" />'.
				'{elseif $mime == \'application/vnd.openxmlformats-officedocument.wordprocessingml.document\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/docx-32.png" alt="Microsoft Office - OOXML - Document" />'.
				'{elseif $mime == \'application/msword\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/doc-32.png" alt="Microsoft Word Document" />'.
				'{elseif $mime == \'application/vnd.openxmlformats-officedocument.presentationml.presentation\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/pptx-32.png" alt="Microsoft Office - OOXML - Presentation" />'.
				'{elseif $mime == \'application/vnd.ms-powerpoint\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/ppt-32.png" alt="Microsoft PowerPoint Presentation" />'.
				'{elseif $mime == \'text/csv\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/csv-32.png" alt="Comma-Seperated Values" />'.
				'{elseif $mime == \'application/pdf\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/pdf-32.png" alt="Adobe Portable Document Format" />'.
				'{elseif $mime == \'application/rtf\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/rtf-32.png" alt="Rich Text Format" />'.
				'{elseif $mime == \'application/zip\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/zip-32.png" alt="Zip Archive" />'.
				'{elseif $mime == \'application/xml\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/xml-32.png" alt="XML - Extensible Markup Language" />'.
				'{elseif $mime == \'text/plain\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/txt-32.png" alt="Text File" />'.
				'{elseif $mime == \'audio/mpeg\'}'.
				'	<img src="{$baseUrl}/default/file/images/types/mp3-32.png" alt="Music File" />'.
				'{/if}'.
			'{/if}'
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
				'delete' => $this->_view->url(array('module' => 'cms', 'controller' => 'admin-file', 'id' => '%id%', 'action' => 'remove'), true),
			)
		));
	}

}

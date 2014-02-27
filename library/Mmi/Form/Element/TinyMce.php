<?php
/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Form/Element/TinyMce.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu TinyMce (zaawansowany edytor tekstu)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_TinyMce extends Mmi_Form_Element_Textarea {

	/**
	 * Funkcja użytkownika, jest wykonywana na końcu konstruktora
	 */
	public function init() {
		$this->addFilter('tinyMce');
		return parent::init();
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$view = Mmi_Controller_Front::getInstance()->getView();
		$view->headScript()->appendFile($view->baseUrl . '/library/js/tiny/tinymce.min.js');

		switch (isset($this->_options['mode']) ? $this->_options['mode'] : null) {
			case 'simple':
				$toolbarOptions = "
					toolbar1 : 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify',
				";
				$plugins = "plugins : 'advlist,anchor,autolink,autoresize,charmap,code,contextmenu,fullscreen,hr,image,insertdatetime,link,lists,media,nonbreaking,noneditable,paste,print,preview,searchreplace,tabfocus,table,template,textcolor,visualblocks,visualchars,wordcount',";
				$theme = "theme : 'modern',";
				$tskin = "skin : 'lightgray',";
				$themeOptions = "image_advtab: true,
				contextmenu: 'link image inserttable | cell row column deletetable',
				width: '" . (isset($this->_options['width']) ? $this->_options['width'] : 400) . "',
				height: '" . (isset($this->_options['height']) ? $this->_options['height'] : 200) . "',
				menubar: false,
				resize : false,
				";
				break;
			case 'advanced':
				$toolbarOptions = "
					toolbar1 : 'undo redo | cut copy paste pastetext | bold italic underline strikethrough | subscript superscript | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect | forecolor backcolor',
					toolbar2 : 'styleselect | table | bullist numlist outdent indent blockquote | link unlink anchor image media code |  preview fullscreen | charmap visualchars nonbreaking inserttime hr template | searchreplace',
				";
				$plugins = "plugins : 'advlist,anchor,autolink,autoresize,charmap,code,contextmenu,fullscreen,hr,image,insertdatetime,link,lists,media,nonbreaking,noneditable,paste,print,preview,searchreplace,tabfocus,table,template,textcolor,visualblocks,visualchars,wordcount',";
				$theme = "theme : 'modern',";
				$tskin = "skin : 'lightgray',";
				$themeOptions = "image_advtab: true,
				contextmenu: 'link image inserttable | cell row column deletetable',
				width: '" . (isset($this->_options['width']) ? $this->_options['width'] : 400) . "',
				height: '" . (isset($this->_options['height']) ? $this->_options['height'] : 200) . "',
				resize : true,
				";
				break;
			default:
				$toolbarOptions = "
					toolbar1 : 'undo redo | bold italic underline strikethrough | forecolor backcolor | styleselect | bullist numlist outdent indent | fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | link unlink anchor image insertfile preview',
				";
				$plugins = "plugins : 'advlist,anchor,autolink,autoresize,charmap,code,contextmenu,fullscreen,hr,image,insertdatetime,link,lists,media,nonbreaking,noneditable,paste,print,preview,searchreplace,tabfocus,table,template,textcolor,visualblocks,visualchars,wordcount',";
				$theme = "theme : 'modern',";
				$tskin = "skin : 'lightgray',";
				$themeOptions = "image_advtab: true,
				contextmenu: 'link image inserttable | cell row column deletetable',
				width: '" . (isset($this->_options['width']) ? $this->_options['width'] : '') . "',
				height: '" . (isset($this->_options['height']) ? $this->_options['height'] : 320) . "',
				";
		}
		unset($this->_options['mode']);
		$class = $this->__get('id');
		$skin = Mmi_Controller_Front::getInstance()->getView()->skin;
		$this->__set('class', trim($this->__get('class') . ' ' . $class));
		$object = '';
		$objectId = '';
		/** opcjonalna funkcja wywoływana po załadowaniu edytorów */
		$onInit = "";
		if (isset($this->_options['oninit']) && $this->_options['oninit'])
		{
			$onInit = "oninit : '".$this->_options['oninit']."',";
		}
		if ($this->getForm()->hasRecord()) {
			$object = $this->getForm()->getFileObjectName();
			$objectId = $this->getForm()->getRecord()->getPk();
		}
		$t = round(microtime(true));
		$hash = md5(Mmi_Session::getId() . '+' . $t . '+' . $objectId);
		$view->headScript()->appendScript("
			tinyMCE.init({
				selector : '.".$class."',
				language : 'pl',
				" . $theme . "
				" . $tskin . "
				" . $plugins . "
				" . $toolbarOptions . "
				" . $themeOptions . "
				" . $onInit . "
				autoresize_min_height: 200,
				image_list: request.baseUrl + '/cms/file/list/object/$object/objectId/$objectId/t/$t/hash/$hash',
				document_base_url: request.baseUrl,
				content_css : request.baseUrl + '/$skin/default/css/default.css',
				convert_urls: false,
				entity_encoding: 'raw',
				relative_urls: false,
				paste_data_images: false,
				font_formats: 'Andale Mono=andale mono,times;'+
					'Arial=arial,helvetica,sans-serif;'+
					'Arial Black=arial black,avant garde;'+
					'Book Antiqua=book antiqua,palatino;'+
					'Comic Sans MS=comic sans ms,sans-serif;'+
					'Courier New=courier new,courier;'+
					'Georgia=georgia,palatino;'+
					'Helvetica=helvetica;'+
					'Impact=impact,chicago;'+
					'Symbol=symbol;'+
					'Tahoma=tahoma,arial,helvetica,sans-serif;'+
					'Terminal=terminal,monaco;'+
					'Times New Roman=times new roman,times;'+
					'Trebuchet MS=trebuchet ms,geneva;'+
					'Verdana=verdana,geneva;'+
					'Webdings=webdings;'+
					'Wingdings=wingdings,zapf dingbats;'+
					'EmpikBTT=EmpikBold;'+
					'EmpikLTT=EmpikLight;'+
					'EmpikRTT=EmpikRegular',
				fontsize_formats: '1px 2px 3px 4px 6px 8px 9pc 10px 11px 12px 13px 14px 16px 18px 20px 22px 24px 26px 28px 36px 48px 50px 72px 100px'
			});
		");

		return parent::fetchField();
	}
}
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

	public function init() {
		$this->addFilter('tinyMce');
		return parent::init();
	}

	public function fetchField() {
		$view = Mmi_View::getInstance();
		$view->headScript()->appendFile($view->baseUrl . '/library/js/tiny/tiny_mce.js');

		switch (isset($this->_options['mode']) ? $this->_options['mode'] : null) {
			case 'simple':
				$toolbarOptions = "
					theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull',
					theme_advanced_buttons2: '',
					theme_advanced_buttons3: '',
					theme_advanced_buttons4: '',
				";
				$plugins = "plugins : 'safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount',";
				$theme = "theme : 'advanced',";
				$themeOptions = "theme_advanced_toolbar_location : 'top',
				theme_advanced_toolbar_align : 'left',
				width: '" . (isset($this->_options['width']) ? $this->_options['width'] : 400) . "',
				height: '" . (isset($this->_options['height']) ? $this->_options['height'] : 200) . "',
				theme_advanced_statusbar_location : 'none',
				theme_advanced_resizing : false,
				";
				break;
			case 'advanced':
				$toolbarOptions = "
					theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect',
					theme_advanced_buttons2 : 'cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor',
					theme_advanced_buttons3 : 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen',
					theme_advanced_buttons4 : 'insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak',
				";
				$plugins = "plugins : 'safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount',";
				$theme = "theme : 'advanced',";
				$themeOptions = "theme_advanced_toolbar_location : 'top',
				theme_advanced_toolbar_align : 'left',
				width: '" . (isset($this->_options['width']) ? $this->_options['width'] : 400) . "',
				height: '" . (isset($this->_options['height']) ? $this->_options['height'] : 200) . "',
				theme_advanced_statusbar_location : 'bottom',
				theme_advanced_resizing : true,
				";
				break;
			default:
				$toolbarOptions = "
					theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,forecolor,image,|,bullist,numlist,|,link,unlink,anchor,|,justifyleft,justifycenter,justifyright,justifyfull,|,tablecontrols,|,formatselect,fontselect,fontsizeselect',
					theme_advanced_buttons2: '',
					theme_advanced_buttons3: '',
					theme_advanced_buttons4: '',
				";
				$plugins = "plugins : 'safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount',";
				$theme = "theme : 'advanced',";
				$themeOptions = "theme_advanced_toolbar_location : 'top',
				width: '" . (isset($this->_options['width']) ? $this->_options['width'] : '') . "',
				height: '" . (isset($this->_options['height']) ? $this->_options['height'] : 320) . "',
				theme_advanced_toolbar_align : 'left',
				theme_advanced_statusbar_location : 'bottom',
				theme_advanced_resizing : false,
				";
		}
		unset($this->_options['mode']);
		$class = $this->__get('id');
		$skin = Mmi_Config::$data['global']['skin'];
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
				mode : 'textareas',
				editor_selector : '".$class."',
				" . $theme . "
				" . $plugins . "
				" . $toolbarOptions . "
				" . $themeOptions . "
				" . $onInit . "
				external_image_list_url : request.baseUrl + '/cms/file/list/object/$object/objectId/$objectId/t/$t/hash/$hash',
				document_base_url: request.baseUrl,
				convert_urls: false 
			});
		");
		//content_css : baseUrl + '/$skin/default/style.css',
		return parent::fetchField();
	}
}
<?php

class Cms_Controller_Widget extends Mmi_Controller_Action {

	public function textWidgetAction() {
		$widgetData = Cms_Model_Widget_Text_Dao::findPk($this->id);
		
		if ($widgetData != null) {
			$this->view->text = $widgetData->data;
		}
		
	}

	public function pictureWidgetAction() {
		
	}

}

<?php

class Cms_Controller_Widget extends Mmi_Controller_Action {

	public function textWidgetAction() {
		$widgetData = Cms_Model_Widget_Text_Dao::findPk($this->id);
		/* @var $widgetData Cms_Model_Widget_Text_Record */

		if ($widgetData != null) {
			$this->view->text = $widgetData->data;
		}
	}

	public function pictureWidgetAction() {
		$picture = Cms_Model_Widget_Picture_Dao::findPk($this->id);
		/* @var $picture Cms_Model_Widget_Picture_Record */

		if ($picture != null) {
			$this->view->imageUrl = $picture->getFirstImage()->getUrl();
		}
	}

}

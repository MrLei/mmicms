<?php


namespace Cms\Controller;

class Widget extends \Mmi\Controller\Action {

	public function textWidgetAction() {
		$widgetData = \Cms\Model\Widget\Text\Dao::findPk($this->id);
		/* @var $widgetData \Cms\Model\Widget\Text\Record */

		if ($widgetData != null) {
			$this->view->text = $widgetData->data;
		}
	}

	public function pictureWidgetAction() {
		$picture = \Cms\Model\Widget\Picture\Dao::findPk($this->id);
		/* @var $picture \Cms\Model\Widget\Picture\Record */

		if ($picture != null) {
			$this->view->imageUrl = $picture->getFirstImage()->getUrl();
		}
	}

}

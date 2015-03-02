<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class Widget extends \Mmi\Controller\Action {

	public function textWidgetAction() {
		$widgetData = \Cms\Model\Widget\Text\Query::factory()->findPk($this->id);
		/* @var $widgetData \Cms\Model\Widget\Text\Record */

		if ($widgetData != null) {
			$this->view->text = $widgetData->data;
		}
	}

	public function pictureWidgetAction() {
		$picture = \Cms\Model\Widget\Picture\Query::factory()->findPk($this->id);
		/* @var $picture \Cms\Model\Widget\Picture\Record */

		if ($picture != null) {
			$this->view->imageUrl = $picture->getFirstImage()->getUrl();
		}
	}

}

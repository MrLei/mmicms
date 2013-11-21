<?php

class Embed_Model_Html {

	public static function getContent($domainId, $contentId, $postData) {
		$cacheKey = 'Embed_' . $domainId . '_' . $contentId;
		if (null === ($embed = Mmi_Cache::load($cacheKey))) {
			$embed = Embed_Model_Dao::findFirstActiveByDomainIdContentId($domainId, $contentId);
			if ($embed->getPk() === null) {
				return 'No content';
			}
			if (Mmi_Config::$data['cache']['active']) {
				Mmi_Cache::save($embed, $cacheKey);
			}
		}
		parse_str($embed->params, $params);
		foreach ($postData as $key => $val) {
			$params[$key] = $val;
		}
		$params['_widget'] = true;
		//osadzenie w iframe
		if ($embed->iframe) {
			$view = Mmi_Controller_Front::getInstance()->getView();
			$params['module'] = $embed->module;
			$params['controller'] = $embed->controller;
			$params['action'] = $embed->action;
			$view->url($params, true, true);
			return '<iframe onload="this.style.height = this.contentWindow.document.body.scrollHeight + \'px\'" id="UC-' . $embed->embed_domain_id . '-' . $embed->encodedId . '" style="border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; border-image: initial; overflow-x: hidden; overflow-y: hidden; height: ' . $embed->height . 'px; width: ' . $embed->width . 'px;" scrolling="no" frameborder="0" src="' . $view->url($params, true, true) . '" ></iframe>';
		}
		//bez iframe
		$actionHelper = new Mmi_Controller_Action_Helper_Action();
		return '<div id="UC-' . $embed->embed_domain_id . '-' . $embed->encodedId . '" style="border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; border-image: initial;">' . $actionHelper->action($embed->module, $embed->controller, $embed->action, $params, true) . '</div>';
	}

}
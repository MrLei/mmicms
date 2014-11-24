<?php

class Embed_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		$origin = '*';
		if (Mmi_Controller_Front::getInstance()->getEnvironment()->httpOrigin) {
			$origin = Mmi_Controller_Front::getInstance()->getEnvironment()->httpOrigin;
		}
		header('Access-Control-Allow-Origin: ' . $origin);
		header('Access-Control-Allow-Credentials: true');

		if (!isset($_POST['id'])) {
			return 'Invalid request.';
		}
		if ($_POST['id'] == 'undefined') {
			return 'No content id provided.';
		}
		if (!isset($_POST['domain'])) {
			return 'No domain provided.';
		}
		$params = array();
		if (!preg_match('/UC-([0-9]+)-([0-9]+)/', $_POST['id'], $params)) {
			return 'Invalid content id.';
		}
		try {
			unset($_POST['id']);
			return Embed_Model_Html::getContent(intval($params[1]), $params[2], $_POST);
		} catch (Exception $e) {
			return '';
		}
	}

	public function siteAction() {
		
	}

}

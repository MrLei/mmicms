<?php

class Embed_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*';
		header('Access-Control-Allow-Origin: ' . $origin);
		header('Access-Control-Allow-Credentials: true');

		if (!isset($_POST['id'])) {
			die('Invalid request.');
		}
		if ($_POST['id'] == 'undefined') {
			die('No content id provided.');
		}
		if (!isset($_POST['domain'])) {
			die('No domain provided.');
		}
		$params = array();
		if (!preg_match('/UC-([0-9]+)-([0-9]+)/', $_POST['id'], $params)) {
			die('Invalid content id.');
		}
		try {
			unset($_POST['id']);
			die(Embed_Model_Html::getContent(intval($params[1]), $params[2], $_POST));
		} catch (Exception $e) {
			die();
		}
	}
	
	public function siteAction() {
		
	}

}
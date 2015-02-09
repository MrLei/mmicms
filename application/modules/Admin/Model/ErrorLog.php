<?php

class Admin_Model_ErrorLog {

	public function getContent() {
		$logFile = TMP_PATH . '/log/error.execution.log';
		return nl2br(file_get_contents($logFile, 0, NULL, filesize($logFile) - 32000));
	}

}

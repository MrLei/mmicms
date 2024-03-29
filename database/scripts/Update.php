<?php

$path = realpath(dirname(__FILE__) . '/../../');
require $path . '/library/Mmi/Application.php';

$application = new Mmi_Application($path, 'MmiCms_Application_Bootstrap_Commandline');
$application->run();

//wyłączenie bufora
ob_end_flush();

//pliki incremental
foreach (glob(BASE_PATH . '/database/' . Default_Registry::$config->db->driver . '/incremental/*.sql') as $file) {
	$md5file = md5_file($file);
	$baseFileName = basename($file);
	$schemaName = substr($baseFileName, strpos($baseFileName, '@') + 1, -4);

	try {
		//ustawianie schematu pliku importu
		Default_Registry::$db->selectSchema($schemaName)
			->setDefaultImportParams();

		//pobranie rekordu
		try {
			$dc = MmiCms_Model_Changelog_Dao::byFilenameQuery(basename($file))->findFirst();
		} catch (Exception $e) {
			$dc = null;
		}
		if ($dc === null) {
			//brak restore
			$dc = new MmiCms_Model_Changelog_Record();
		} elseif ($dc !== null && $dc->md5 == $md5file) {
			//restore istnieje md5 zgodne
			echo 'INCREMENTAL PRESENT: ' . $baseFileName . "\n";
			continue;
		} else {
			//restore istnieje md5 niezgodne
			echo 'INVALID MD5: ' . $baseFileName . ' --- VALID: ' . $md5file . " --- IMPORT TERMINATED!\n";
			break;
		}
	} catch (Exception $e) {
		echo 'NO SCHEMA FOUND - INITIAL IMPORT ' . $e->getMessage() . "\n";
		if (!isset($dc) || $dc === null) {
			//brak restore
			$dc = new MmiCms_Model_Changelog_Record();
		}
	}

	//import danych
	//if(Default_Registry::$config->db->driver != "oci") {
		$result = Default_Registry::$db->getPdo()->exec(file_get_contents($file));
		if ($result === false) {
			var_dump(Default_Registry::$db->getPdo()->errorInfo());
			exit;
		}
	
	//tworzenie wpisu
	MmiCms_Model_Changelog_Dao::resetTableStructures();
	$dc->filename = $baseFileName;
	$dc->md5 = $md5file;
	$dc->save();
	echo 'RESTORE INCREMENTAL: ' . $baseFileName . "\n";
}
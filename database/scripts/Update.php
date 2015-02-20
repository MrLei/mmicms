<?php

$path = realpath(dirname(__FILE__) . '/../../');
require $path . '/library/Mmi/Application.php';

$application = new \Mmi\Application($path, 'MmiCms\Application\Bootstrap\Commandline');
$application->run();

//wyłączenie bufora
ob_end_flush();

//pliki incremental
foreach (glob(BASE_PATH . '/database/' . Core\Registry::$config->db->driver . '/incremental/*.sql') as $file) {
	$md5file = md5_file($file);
	$baseFileName = basename($file);
	$schemaName = substr($baseFileName, strpos($baseFileName, '@') + 1, -4);

	try {
		//ustawianie schematu pliku importu
		Core\Registry::$db->selectSchema($schemaName)
			->setDefaultImportParams();

		//pobranie rekordu
		try {
			$dc = MmiCms\Model\Changelog\Dao::byFilenameQuery(basename($file))->findFirst();
		} catch (Exception $e) {
			$dc = null;
		}
		if ($dc === null) {
			//brak restore
			$dc = new \MmiCms\Model\Changelog\Record();
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
			$dc = new \MmiCms\Model\Changelog\Record();
		}
	}

	//import danych
	//if(Core\Registry::$config->db->driver != "oci") {
		$result = Core\Registry::$db->getPdo()->exec(file_get_contents($file));
		if ($result === false) {
			var_dump(Core\Registry::$db->getPdo()->errorInfo());
			exit;
		}
	
	//tworzenie wpisu
	MmiCms\Model\Changelog\Dao::resetTableStructures();
	$dc->filename = $baseFileName;
	$dc->md5 = $md5file;
	$dc->save();
	echo 'RESTORE INCREMENTAL: ' . $baseFileName . "\n";
}
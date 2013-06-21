<?php

define('BASE_PATH', dirname(__FILE__) . '/../..');
define('TMP_PATH', BASE_PATH . '/tmp');
define('HOST', null);

//libraries
include BASE_PATH . '/library/Mmi/Config.php';
include BASE_PATH . '/library/Mmi/Registry.php';
include BASE_PATH . '/library/Mmi/Dao.php';
include BASE_PATH . '/library/Mmi/Dao/Record/Ro.php';
include BASE_PATH . '/library/Mmi/Dao/Record.php';
include BASE_PATH . '/library/Mmi/Db/Adapter/Pdo/Abstract.php';
include BASE_PATH . '/library/MmiCms/Model/Changelog/Dao.php';
include BASE_PATH . '/library/MmiCms/Model/Changelog/Record.php';

//config
include BASE_PATH . '/application/configs/application.php';
include BASE_PATH . '/application/configs/local.php';

//including proper driver
$driver = $_['db']['driver'];
include BASE_PATH . '/library/Mmi/Db/Adapter/Pdo/' . ucfirst($driver) . '.php';

unset($_['db']['schema']);
$_['cache']['active'] = false;
Mmi_Config::setConfig($_);

$adapter = 'Mmi_Db_Adapter_Pdo_' . ucfirst($driver);

//database connection
$db = new $adapter($_['db']);
$db->setDefaultImportParams();

//setting up the registry
Mmi_Registry::set('Mmi_Db', $db);

//incremental files check
foreach (glob(BASE_PATH . '/database/' . $driver . '/incremental/*.sql') as $file) {
	$md5file = md5_file($file);
	$baseFileName = basename($file);
	$schemaName = substr($baseFileName, strpos($baseFileName, '@') + 1, -4);

	try {
		//ustawianie schematu pliku importu
		$db->selectSchema($schemaName);

		//pobranie rekordu
		$dc = MmiCms_Model_Changelog_Dao::findFirst(array('filename', basename($file)));

		if ($dc === null) {
			//brak restore
			$dc = new MmiCms_Model_Changelog_Record();
		} elseif ($dc !== null && $dc->md5 == $md5file) {
			//restore istnieje md5 zgodne
			echo 'INCREMENTAL PRESENT: ' . $baseFileName . "\n";
			continue;
		} else  {
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
	$result = $db->exec(file_get_contents($file));
	if ($result === false) {
		var_dump($db->getPdo()->errorInfo());
		exit;
	}
	//tworzenie wpisu
	$dc->filename = $baseFileName;
	$dc->md5 = $md5file;
	$dc->save();
	echo 'RESTORE INCREMENTAL: ' . $baseFileName . "\n";
}
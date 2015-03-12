<?php

//powołanie i uruchomienie aplikacji
$path = realpath(dirname(__FILE__) . '/../../../../');
require $path . '/library/Mmi/Application.php';

$application = new \Mmi\Application($path, 'MmiCms\Application\Bootstrap\Commandline');
$application->run();

//ustawienie typu odpowiedzi na plain
\Mmi\Controller\Front::getInstance()->getResponse()->setTypePlain();

//pliki incremental
foreach (glob(APPLICATION_PATH . '/modules/Core/Database/' . \Core\Registry::$config->db->driver . '/incremental/*.sql') as $file) {

	//nazwa pliku
	$baseFileName = basename($file);

	//brak nazwy schematu
	if (strpos($baseFileName, '@') === false) {
		throw new \Exception('Filename ' . $baseFileName . ' invalid: no schema name after "@"');
	}
	
	//hash pliku
	$md5file = md5_file($file);
	
	//wyliczanie nazwy schematu bazy danych (dla silników, które tego używają
	$schemaName = substr($baseFileName, strpos($baseFileName, '@') + 1, -4);

	//ustawianie schematu pliku importu i domyślnych parametrów importu
	\Core\Registry::$db->selectSchema($schemaName)
		->setDefaultImportParams();

	//pobranie rekordu
	try {
		$dc = \MmiCms\Model\Changelog\Dao::byFilenameQuery(basename($file))->findFirst();
	} catch (Exception $e) {
		$dc = null;
	}

	//restore istnieje md5 zgodne
	if ($dc !== null && $dc->md5 == $md5file) {
		echo 'INCREMENTAL PRESENT: ' . $baseFileName . "\n";
		continue;
	}

	//restore istnieje md5 niezgodne - plik się zmienił - przerwanie importu
	if ($dc !== null) {
		echo 'INVALID MD5: ' . $baseFileName . ' --- VALID: ' . $md5file . " --- IMPORT TERMINATED!\n";
		break;
	}
	//brak restore - zakłada nowy changelog
	$newDc = new \MmiCms\Model\Changelog\Record();

	//import danych
	$result = \Core\Registry::$db->getPdo()->exec(file_get_contents($file));
	if ($result === false) {
		//błąd zapytania
		echo \Core\Registry::$db->getPdo()->errorInfo()[2] . "\n";
		break;
	}
	
	//tworzenie wpisu
	\MmiCms\Model\Changelog\Dao::resetTableStructures();
	
	//zapis informacji o incrementalu
	$newDc->filename = $baseFileName;
	$newDc->md5 = $md5file;
	$newDc->save();
	
	//informacja na ekran
	echo 'RESTORE INCREMENTAL: ' . $baseFileName . "\n";
}
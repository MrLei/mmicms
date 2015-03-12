<?php

//powołanie i uruchomienie aplikacji
$path = realpath(dirname(__FILE__) . '/../../../../../');
require $path . '/library/Mmi/Application.php';

$application = new \Mmi\Application($path, 'MmiCms\Application\Bootstrap\Commandline');
$application->run();

//ustawienie typu odpowiedzi na plain
\Mmi\Controller\Front::getInstance()->getResponse()->setTypePlain();

//odbudowanie wszystkich DAO/Record/Query/Field/Join
foreach (\Core\Registry::$db->tableList(\Core\Registry::$config->db->schema) as $tableName) {
	echo 'Rendering for: ' . $tableName . "\n";
	//buduje struktruę dla tabeli
	\Mmi\Dao\Builder::buildFromTableName($tableName);
}

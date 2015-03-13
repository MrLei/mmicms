<?php

//określanie ścieżki
$path = realpath(dirname(__FILE__) . '/../');

//ładowanie klasy aplikacji
require $path . '/application/modules/Mmi/Application.php';

//powołanie i uruchomienie aplikacji
$application = new \Mmi\Application($path, '\Cms\Application\Bootstrap');
$application->run();
<?php

//określanie ścieżki
$path = realpath(dirname(__FILE__) . '/../');

//ładowanie klasy aplikacji
require $path . '/library/Mmi/Application.php';

//powołanie i uruchomienie aplikacji
$application = new Mmi_Application($path, 'MmiCms_Application_Bootstrap');
$application->run();
<?php

$path = realpath(dirname(__FILE__) . '/../../../../');
require $path . '/library/Mmi/Application.php';

$application = new Mmi_Application($path, 'MmiCms_Application_Bootstrap_Commandline');
$application->run();

Cron_Model_Job::run();

<?php

$path = realpath(dirname(__FILE__) . '/../../../../');
require $path . '/application/modules/Mmi/Application.php';

$application = new \Mmi\Application($path, 'Cms\Application\BootstrapCli');
$application->run();

Cms\Model\Cron\Job::run();

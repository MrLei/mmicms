<?php

$path = realpath(dirname(__FILE__) . '/../../../');
require $path . '/library/Mmi/Application.php';

$application = new \Mmi\Application($path, 'MmiCms\Application\Bootstrap\Commandline');
$application->run();

Cms\Model\Cron\Job::run();

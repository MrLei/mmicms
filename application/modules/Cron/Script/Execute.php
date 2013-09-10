<?php
$path = realpath(dirname(__FILE__) . '/../../../../');
require $path . '/library/Mmi/Bootstrap.php';
require $path . '/library/Mmi/Bootstrap/Cmd.php';

$bootstrap = new Mmi_Bootstrap_Cmd($path);
$bootstrap->run();

Cron_Model_Job::run();
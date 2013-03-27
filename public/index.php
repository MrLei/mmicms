<?php

$path = realpath(dirname(__FILE__) . '/../');
require $path . '/library/Mmi/Bootstrap.php';

$bootstrap = new Mmi_Bootstrap($path);
$bootstrap->run();
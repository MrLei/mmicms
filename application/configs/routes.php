<?php

$_['routes'][0]['pattern'] = '/^strona\/(.[^\/]+)/';
$_['routes'][0]['replace'] = array('module' => 'cms', 'controller' => 'article', 'action' => 'index', 'uri' => '$1');
$_['routes'][0]['default'] = array('lang' => 'pl');
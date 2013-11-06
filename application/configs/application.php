<?php

$_['session']['name'] = 'MmiCms';
$_['session']['cookie_lifetime'] = '0';
$_['session']['cache_expire'] = '14400';
$_['session']['gc_divisor'] = '1000';
$_['session']['gc_maxlifetime'] = '28800';
$_['session']['gc_probability'] = '1';
$_['session']['remember_me_seconds'] = '31536000';
$_['session']['save_handler'] = 'files';
$_['session']['save_path'] = TMP_PATH . '/session';
//$_['session']['save_handler'] = 'user';
//$_['session']['save_path'] = 'apc';
//$_['session']['save_handler'] = 'memcached';
//$_['session']['save_path'] = '127.0.0.1:11211';

$_['global']['charset'] = 'utf-8';
$_['global']['debug'] = false;
$_['global']['timeZone'] = 'Europe/Warsaw';
$_['global']['skin'] = 'default';
$_['global']['languages'][0] = 'pl';
$_['global']['php']['display_errors'] = 1;

$_['plugins'][0] = 'MmiCms_Controller_Plugin';

$_['cms']['mediaServer'] = '';

$_['cache']['active'] = true;
$_['cache']['lifetime'] = 360;
$_['cache']['save_handler'] = 'file';
$_['cache']['save_path'] = TMP_PATH . '/cache';
//$_['cache']['save_handler'] = 'memcached';
//$_['cache']['save_path'] = '127.0.0.1:11211';
//$_['cache']['save_handler'] = 'apc';

$_['db']['host'] = '';
$_['db']['driver'] = '';
$_['db']['dbname'] = '';
$_['db']['username'] = '';
$_['db']['password'] = '';
$_['db']['charset'] = 'utf8';
$_['db']['persistent'] = true;
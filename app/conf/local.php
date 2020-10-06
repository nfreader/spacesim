<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set('xdebug.var_display_max_depth',-1);
ini_set('xdebug.var_display_max_data',-1);
ini_set('xdebug.var_display_max_children',-1);

$settings['debug'] = true;
$settings['twig']['options']['debug'] = true;
// $settings['twig']['options']['auto_reload'] = true;
// $settings['twig']['options']['cache_enabled'] = false;


$settings['database']['host'] = 'mariadb';
$settings['database']['database'] = 'track';
$settings['database']['password'] = '123';

$settings['error']['display_error_details'] = true;
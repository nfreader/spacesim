<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_data', -1);
ini_set('xdebug.var_display_max_children', -1);

$settings['debug'] = true;
$settings['twig']['options']['debug'] = true;
// $settings['twig']['options']['auto_reload'] = true;
// $settings['twig']['options']['cache_enabled'] = false;


$settings['database']['host'] = 'mariadb';
$settings['database']['database'] = 'ssim';
$settings['database']['password'] = '123';

$settings['error']['display_error_details'] = true;

$settings['auth']['discord']['OAUTH2_CLIENT_ID'] = '764142441913516114';
$settings['auth']['discord']['OAUTH2_CLIENT_SECRET'] = 'KBfazbAh7MI2IbuloMD9L7EXCx8jt_Rr';

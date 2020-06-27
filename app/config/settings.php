<?php
if(!defined('SSIM_DEBUG')) define('SSIM_DEBUG', FALSE);
if(!defined('SSIM_ENVIRONMENT')) define('SSIM_ENVIRONMENT', 'PROD');
define('SSIM_DB_DSN', SSIM_DB_METHOD.":host=".SSIM_DB_HOST.";port=".SSIM_DB_PORT.";dbname=".SSIM_DB_NAME);
$year = date('Y') + SSIM_YEAR;
return [
  "twig" => [
    "template_dir" => __DIR__ . "/../../resources/views",
    "cache" => "/tmp",
    "debug" => SSIM_DEBUG === TRUE ? true : false
  ],
  'application' => [
    'name'  => SSIM_NAME,
    'debug' => SSIM_DEBUG === TRUE ? true : false,
    'date'  => date("Hi d.m.$year"),
    'year'  => SSIM_YEAR,
    'timezone' => SSIM_TIMEZONE,
    'version' => SSIM_VERSION
  ],
  'database' => [
    'DB_METHOD' => SSIM_DB_METHOD,
    'DB_HOST'   => SSIM_DB_HOST,
    'DB_PORT'   => SSIM_DB_PORT,
    'DB_NAME'   => SSIM_DB_NAME,
    'DB_USER'   => SSIM_DB_USER,
    'DB_PASS'   => SSIM_DB_PASS,
    'DB_DSN'    => SSIM_DB_DSN
  ],
];  
<?php
if(!defined('SSIM_DEBUG')) define('SSIM_DEBUG', FALSE); //Failsafe
if(!defined('SSIM_ENVIRONMENT')) define('SSIM_ENVIRONMENT', 'PROD'); //Failsafe
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
    'timezone' => SSIM_TIMEZONE,
    'version' => SSIM_VERSION
  ],
  'game' => [
    'date'  => date("Hi d.m.$year"),
    'year'  => SSIM_YEAR,
    'fuel_base_cost' => SSIM_FUEL_BASE_COST
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
  'permissions_flags' => [
    'ADMIN' => (1<<0),
    'GALAXY' => (1<<1),
    'GOVERNMENTS' => (1<<2),
    'COMMODITIES' => (1<<3),
    'OUTFITS' => (1<<4),
    'SHIPS' => (1<<5)
  ]
];  
<?php 

#Debug flag. Defaults to false.
define('SSIM_DEBUG', FALSE);

# Name of your Space Sim application
define('SSIM_NAME', 'Space Sim');

# How far in the future the game is set
define('SSIM_YEAR', date('Y') + 178);

#Timezone. This should probably be left alone.
define('SSIM_TIMEZONE','UTC');

#Database credentials
define('SSIM_DB_METHOD','mysql');
define('SSIM_DB_HOST','mariadb');
define('SSIM_DB_PORT',3306);
define('SSIM_DB_NAME','ssim');
define('SSIM_DB_USER','root');
define('SSIM_DB_PASS','123');
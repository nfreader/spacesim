<?php
mb_internal_encoding('UTF-8');
$utf_set = ini_set('default_charset', 'utf-8');
if (!$utf_set) {
    throw new Exception('could not set default_charset to utf-8, please ensure it\'s set on your system!');
}
mb_http_output('UTF-8');
ini_set('xdebug.var_display_max_depth',-1);
ini_set('xdebug.var_display_max_data',-1);
ini_set('xdebug.var_display_max_children',-1);

(require __DIR__ . '/../app/bootstrap.php')->run();
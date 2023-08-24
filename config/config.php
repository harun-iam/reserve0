<?php
error_reporting(E_ALL & ~E_WARNING);

ini_set('date.timezone', 'Asia/Tokyo');

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'reserve');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

define('ADMIN_EMAIL', 'admin@example.com');

mb_language('Japanese');
mb_internal_encoding('UTF-8');
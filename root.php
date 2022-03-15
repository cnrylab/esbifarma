<?php // error_reporting(0);
define('time_start', microtime(true));
date_default_timezone_set('Asia/Jakarta');

define('urlBase', 'https://'.$_SERVER["SERVER_NAME"].'/');
define('dirBase', $_SERVER['DOCUMENT_ROOT'].'/');

define('urlFlex', 'https://'.$_SERVER["SERVER_NAME"].'/cnryflex/');
define('dirFlex', dirname(__FILE__).'/cnryflex/');
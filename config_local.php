<?php

// Definindo header UTF-8
header ('Content-type: text/html; charset=UTF-8');

// Definindo timezone Default
date_default_timezone_set('America/Fortaleza');

// Definindo o layout

define('LAYOUT_NAME', 'lte-2');

// Definindo DB parametros
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "spi_cabralgama");

// Definindo URL
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define("ROOT_PATH", "/spi/");

define("URL_ROOT", "http://php.dev/spi/");
define('DIR_IMG', 'http://php.dev/spi/assets/img/');
define('DIR_FORMS', 'http://php.dev/spi/lib/forms/');
define('DIR_LAYOUT', 'app/views/lte-2/');
define('URL_MIN' , 'http://php.dev/min/?f=spi/' );





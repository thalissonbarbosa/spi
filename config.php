<?php

// Definindo header UTF-8
header ('Content-type: text/html; charset=UTF-8');

// Definindo timezone Default
date_default_timezone_set('America/Fortaleza');

// Definindo o layout

define('LAYOUT_NAME', 'lte-2');

// Definindo DB parametros
define("DB_HOST", "localhost");
define("DB_USER", "cabra031");
define("DB_PASS", "007thasa*");
define("DB_NAME", "cabra031_spicg");

// Definindo URL
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define("ROOT_PATH", "/spi/");

define("URL_ROOT", "http://cabralgama.com/spi/");
define('DIR_IMG', 'http://cabralgama.com/spi/assets/img/');
define('DIR_FORMS', 'http://cabralgama.com/spi/lib/forms/');
define('DIR_LAYOUT', 'app/views/lte-2/');
define('URL_MIN' , 'http://cabralgama.com/min/f=spi/' );

<?php

require_once '../App/Lib/functions.php';

/**
 * ============== Developement Mode ==============
 * if DEV_MODE = true  -> ON
 * if DEV_MODE = false -> OFF
 * then if DEV_MODE is on the developement errors will show
 * then if DEV_MODE is off the developement errors will hidden
 */
define('DEV_MODE', true);

/**
 * ============== Directory Separator ==============
 * Like this -> for windows \
 * Like this -> for mac & linux /
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * ============== App path ==============
 * Like this -> C:\xampp\htdocs\MVCFramework\App
 */
define('APP_PATH', dirname(__FILE__));
define('VIEWS_PATH', APP_PATH . DS . 'Views');
define('CONTROLLERS_PATH', APP_PATH . DS . 'Controllers');
define('MODELS_PATH', APP_PATH . DS . 'Models');
define('LIB_PATH', APP_PATH . DS . 'Lib');
define('PUBLIC_PATH', APP_PATH . DS . '..' . DS . 'Public');

/**
 * ============== Database Configrations ==============
 * Open -> [ /App/Lib/Database ] folder
 */
define('DATABASE_HOST_NAME', 'localhost');
define('DATABASE_NAME', 'mvcFramework');
define('DATABASE_USER_NAME', 'root');
define('DATABASE_PASSWORD', '');
define('DATABASE_PORT_NUMBER', 3306);
/**
 * PDO DRIVER = 1
 * MYSQLI DRIVER = 2
 */
define('DATABASE_DRIVER', 1);

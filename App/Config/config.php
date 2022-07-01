<?php

define('APP_NAME', 'MVCFramework');


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
define('APP_PATH', rtrim(dirname(__FILE__), "Config"));
define('CONTROLLERS_PATH', APP_PATH . 'Controllers' . DS);
define('MODELS_PATH', APP_PATH . 'Models' . DS);
define('VIEWS_PATH', APP_PATH . 'Views' . DS);
define('CONFIG_PATH', dirname(__FILE__) . DS);
define('LIB_PATH', APP_PATH . 'Lib' . DS);
define('PUBLIC_PATH', APP_PATH . '..' . DS . 'Public' . DS);
define('UPLOADS_PATH', PUBLIC_PATH . 'uploads' . DS);
define('ASSETS_PATH', PUBLIC_PATH . 'assets' . DS);
define('CSS_PATH', ASSETS_PATH . 'css' . DS);
define('JS_PATH', ASSETS_PATH . 'js' . DS);
define('IMAGES_PATH', ASSETS_PATH . 'images' . DS);
define('LAYOUT_PATH', VIEWS_PATH . 'layout' . DS);

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

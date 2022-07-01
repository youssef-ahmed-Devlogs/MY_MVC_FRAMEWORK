<?php

namespace App\Lib;

class Autoload
{
    public static function autoload($className): void
    {
        $className = APP_PATH . str_replace("App", "", $className) . '.php';

        if (file_exists($className)) {
            require_once  $className;
        }
    }
}

// Register my autoload method in spl
spl_autoload_register(__NAMESPACE__ . '\Autoload::autoload');

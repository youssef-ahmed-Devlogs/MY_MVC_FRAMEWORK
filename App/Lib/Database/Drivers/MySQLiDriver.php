<?php

namespace App\Lib\Database\Drivers;

use App\Lib\Database\DatabaseHandler;

class MySQLiDriver extends DatabaseHandler
{
    public function __construct()
    {
        self::init();
    }

    protected static function init(): void
    {
        echo "new mysqli";
    }
}

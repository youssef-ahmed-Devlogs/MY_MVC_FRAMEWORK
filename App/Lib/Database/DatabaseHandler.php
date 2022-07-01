<?php

namespace App\Lib\Database;

use App\Lib\Database\Drivers\MySQLiDriver;
use App\Lib\Database\Drivers\PDODriver;

abstract class DatabaseHandler
{
    protected static $connection;

    const PDO_DRIVER = 1;
    const MYSQLI_DRIVER = 2;

    /**
     * Select database driver
     * @return DatabaseHandler
     */
    public static function factory()
    {
        if (DATABASE_DRIVER == self::PDO_DRIVER) {
            $pdo = new PDODriver;
            return $pdo->getInstance();
        }

        if (DATABASE_DRIVER == self::MYSQLI_DRIVER) {
            return new MySQLiDriver;
        }
    }

    /**
     * Connect to database
     * @return void
     */
    abstract protected static function init(): void;
}

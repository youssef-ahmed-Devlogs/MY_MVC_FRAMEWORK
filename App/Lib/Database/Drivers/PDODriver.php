<?php

namespace App\Lib\Database\Drivers;

use App\Lib\Database\DatabaseHandler;
use PDOException;
use PDOStatement;

class PDODriver extends DatabaseHandler
{
    private static $instance;

    public function __construct()
    {
        //Connect to database
        self::init();
    }

    /**
     * Connect to database
     *
     * @return void
     */
    protected static function init(): void
    {
        /**
         * dsn = [ mysql:hostname=myhostname;dbname=mydbname ]
         * username = [ root ]
         * password = [ 123456 ]
         */
        $dsn = 'mysql:hostname=' . DATABASE_HOST_NAME . ';dbname=' . DATABASE_NAME;
        $options = [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];
        try {
            static::$connection = new \PDO($dsn, DATABASE_USER_NAME, DATABASE_PASSWORD, $options);
        } catch (PDOException $e) {
            if (DEV_MODE) {
                echo "<h1>Failed connect.</h1>";
                echo "<p>{$e}</p>";
            }
        }
    }

    public function getInstance(): \PDO
    {
        return static::$connection;
    }
}

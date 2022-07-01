<?php

namespace App\Lib;

abstract class Request
{
    private static array $getParams = [];
    private static array $postParams = [];

    public static function init(array $getParams): void
    {
        static::$getParams = $getParams;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            static::$postParams = $_POST;
        }
    }

    public static function get(): array
    {
        return static::$getParams;
    }

    public static function post(): array
    {
        return static::$postParams;
    }
}

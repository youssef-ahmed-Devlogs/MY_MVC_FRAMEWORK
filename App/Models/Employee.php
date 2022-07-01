<?php

namespace App\Models;

class Employee extends Model
{
    protected static string $tableName = 'employees';
    protected static array $tableSchema = [
        "name" => "string",
        "age" => "int",
        "address" => "string",
        "tax" => "float",
        "salary" => "float"
    ];
    protected static bool $SoftDelete = true;

    public function __construct()
    {
    }
}

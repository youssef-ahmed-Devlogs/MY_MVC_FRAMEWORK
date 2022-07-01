<?php

namespace App\Models;

use App\Lib\Database\DatabaseHandler;

abstract class Model
{
    /**
     * Table id column
     */
    protected $id;

    /**
     * Model Configration
     */
    protected static string $primaryKey = 'id';
    protected static string $tableName;
    protected static array $tableSchema = [];
    protected static bool $SoftDelete = false;

    private function create(): bool
    {
        /**
         * - $columns
         * Generate columns binds string from [ static::tableSchema ]
         * Like -> "name = :name, address = :address, age = :age, ..."
         * to use them in $sql statement
         * 
         * - $values
         * Generate values binds array from [ static::tableSchema ]
         * Like ->
         * [ ":name" => "Ahmed", ":address" =>  "Cairo, Egypt", ":age" =>  21 ]
         * to use them in execute($values) method
         */
        $columns = "";
        $values = [];

        foreach (static::$tableSchema as $column => $datatype) {
            $columns .= $column . ' = ' . ':'  . $column . ', ';
            $values[":$column"] = $this->$column;
        }

        /**
         * Remove last coma from string
         * "name = :name, address = :address, age = :age," <-
         * "name = :name, address = :address, age = :age" <-
         */
        $columns = trim($columns, ", ");

        $sql = "INSERT INTO " . static::$tableName . " SET $columns";
        $stmt = DatabaseHandler::factory()->prepare($sql);

        if ($stmt->execute($values)) {
            $this->id = $this->lastInsertedId();

            return true;
        }

        return false;
    }

    private function update(): bool
    {
        /**
         * - $columns
         * Generate columns binds string from [ static::tableSchema ]
         * Like -> "name = :name, address = :address, age = :age, ..."
         * to use them in $sql statement
         * 
         * - $values
         * Generate values binds array from [ static::tableSchema ]
         * Like ->
         * [ ":name" => "Ahmed", ":address" =>  "Cairo, Egypt", ":age" =>  21 ]
         * to use them in execute($values) method
         */
        $columns = "";
        $values = [];

        foreach (static::$tableSchema as $column => $datatype) {
            $columns .= $column . ' = ' . ':'  . $column . ', ';
            $values[":$column"] = $this->$column;
        }

        /**
         * Remove last coma from string
         * "name = :name, address = :address, age = :age," <-
         * "name = :name, address = :address, age = :age" <-
         */
        $columns = trim($columns, ", ");

        $sql = "UPDATE " . static::$tableName . " SET $columns WHERE " . static::$primaryKey . " = " . $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);

        return $stmt->execute($values);
    }

    public function save()
    {
        /**
         * if current object has a id then
         * call update() method
         * else call create() method
         */
        if ($this->{static::$primaryKey}) {
            return $this->update();
        }

        return $this->create();
    }

    public function delete(): bool
    {
        $sql = "DELETE FROM " . static::$tableName . " WHERE " . static::$primaryKey . " = :" . static::$primaryKey;
        $stmt = DatabaseHandler::factory()->prepare($sql);

        return $stmt->execute([':' . static::$primaryKey => $this->{static::$primaryKey}]);
    }

    public function softDelete(): bool
    {
        $sql = "UPDATE " . static::$tableName . " SET softDelete = :softDelete WHERE " . static::$primaryKey . " = : " . static::$primaryKey;
        $stmt = DatabaseHandler::factory()->prepare($sql);

        return $stmt->execute([':softDelete' => 1, ':' . static::$primaryKey => $this->{static::$primaryKey}]);
    }

    public function restore(): bool
    {
        $sql = "UPDATE " . static::$tableName . " SET softDelete = :softDelete WHERE " . static::$primaryKey . " = :" . static::$primaryKey;
        $stmt = DatabaseHandler::factory()->prepare($sql);

        return $stmt->execute([':softDelete' => 0, ':' . static::$primaryKey => $this->{static::$primaryKey}]);
    }

    public static function all($softDeleted = false): array
    {
        $sql = "SELECT * FROM " . static::$tableName;

        /**
         * if static::$SoftDelete [ true ]
         * select only softDelete colomun = 0
         * [ softDelete coloumn = 0 ] that is mean not deleted
         * [ softDelete coloumn = 1 ] that is mean deleted
         */
        if (static::$SoftDelete) {
            $sql = "SELECT * FROM " . static::$tableName . ' WHERE softDelete = 0';
        }

        /**
         * if softDelete parameter [ true ]
         * select all with softDeleted colomuns
         */
        if ($softDeleted) {
            $sql = "SELECT * FROM " . static::$tableName;
        }

        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        $arrayOfObjects = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        return $arrayOfObjects;
    }

    public static function get($val, $columns = ["*"], $softDeleted = false) // : Model | false
    {
        $arrayOfObjects = static::where([static::$primaryKey => $val], $columns, $softDeleted);

        if (count($arrayOfObjects)) {
            return array_shift($arrayOfObjects);
        }

        return false;
    }

    public static function where($conditions, $columns = ["*"], $softDeleted = false): array
    {
        /**
         * 
         * - $props
         * Generate columns binds string from [ $conditions ] parameters
         * Like -> name = :name AND address = :address AND age = :age
         * to use them in $sql statement after [ WHERE ] word
         * 
         * - $values
         * Generate values binds array from [ static::tableSchema ]
         * Like ->
         * [ ":name" => "Ahmed", ":address" =>  "Cairo, Egypt", ":age" =>  21 ]
         * to use them in execute($values) method
         */
        $props = '';
        $values = [];

        /**
         * Convert $columns[] to string
         * [ 'name', 'address', 'age' ]
         * "name, address, age"
         */
        $columns = implode(",", $columns);

        foreach ($conditions as $key => $val) {
            $props .=  $key . ' = :' . $key . ' AND ';
            $values[":$key"] = $val;
        }

        /**
         * Remove last [ AND ]
         * and add [ WHERE ] first
         */
        $props = rtrim($props, " AND ");
        $props = ' WHERE ' . $props;

        $sql = "SELECT {$columns} FROM " . static::$tableName . $props;

        /**
         * if static::$SoftDelete [ true ]
         * select only softDelete colomun = 0
         * [ softDelete coloumn = 0 ] that is mean not deleted
         * [ softDelete coloumn = 1 ] that is mean deleted
         */
        if (static::$SoftDelete) {
            $sql = "SELECT {$columns} FROM " . static::$tableName . $props . ' AND softDelete = 0';
        }

        /**
         * if softDelete parameter [ true ]
         * select all with softDeleted colomuns
         */
        if ($softDeleted) {
            $sql = "SELECT {$columns} FROM " . static::$tableName . $props;
        }

        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute($values);
        $arrayOfObjects = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));

        return $arrayOfObjects;
    }

    public static function lastInsertedId()
    {
        $sql = "SELECT id FROM " . static::$tableName . " ORDER BY id DESC LIMIT 1";
        $stmt = DatabaseHandler::factory()->prepare($sql);

        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }

        return 0;
    }
}

<?php
abstract class BaseModel
{
    protected static $pdo;

    public function __construct()
    {
        if (self::$pdo === null) {
            throw new RuntimeException("Not setup data for bd");
        }
    }

    public static function init($database)
    {
        self::$pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=". $database['database'] . "", $database['username'], $database['password']);
    }
}
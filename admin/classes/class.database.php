<?php

class Database
{
    private static $conn;

    public static function getInstance()
    {
        self::$conn = new PDO("mysql:charset=utf8mb4;host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return self::$conn;
    }
}

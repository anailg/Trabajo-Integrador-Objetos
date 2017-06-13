<?php

class DB {

    private static $conn;

    public static function getConn()
    {
        if (!self::$conn) {
            $dsn = "mysql:host=localhost;dbname=cooking_company;charset=utf8;port=3306";
            $username='root';
            $password='';
            $db = new PDO($dsn, $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn = $db;
        }
        return self::$conn;
    }

}

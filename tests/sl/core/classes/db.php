<?php

class Db
{
    private static $db;

    public static function init()
    {
        if (!self::$db)
        {
            try {
                $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
                self::$db = new PDO($dsn, DB_USER, DB_PASS ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Connection error: ' . $e->getMessage());
            }
        }
        self::$db-> exec("SET NAMES utf8");
        return self::$db;
    }
}
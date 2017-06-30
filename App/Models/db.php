<?php

class Database
{
    //static = create only one, and is not an instance of an object
    private static $dsn = 'mysql:host=localhost;dbname=citlabmonitor';
    private static $username = 'root';
    private static $password = '';
    private static $options = array(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    private static $db;

    private function __construct()
    {
    }

    public static function getDB()
    {
        if (!isset(self::$db)) {
            self::$db = new PDO(self::$dsn, self::$username, self::$password, self::$options);
        }
        return self::$db;
    }
}

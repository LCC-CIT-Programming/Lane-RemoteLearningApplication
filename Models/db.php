<?php

class Database {
	//static = create only one, and is not an instance of an object
    private static $dsn = 'mysql:host=localhost:3307;dbname=CITLabMonitor';
    private static $username = 'cittest';
    private static $password = 'password';
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
            	//throws an error if there is a problem with the connection, not if there is an issue with the database
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
				self::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
				echo $error_message;
                //include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}


?>

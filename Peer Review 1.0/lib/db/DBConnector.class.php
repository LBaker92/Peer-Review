<?php

include_once 'DBDefinitions.inc.php';

class DBConnector {

    private static $instance = null;
    private static $db = null;

    protected function __construct() {
        try {
            self::$db = new PDO(DBCONNECTION, DBUSER, DBPASS);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function createInstance() {
        if (self::$instance == null) {
            self::$instance = new DBConnector();
        }
        return self::$instance;
    }

    public function getConnection() {
        return self::$db;
    }

}

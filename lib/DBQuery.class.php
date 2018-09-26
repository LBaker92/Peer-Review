<?php

class DBQuery {

    private static $pdo = null;

    function __construct() { }

    public function setConnection() {
        self::$pdo = DBConnector::getInstance()->getConnection();
    }

    public function run_query($sql) {
        self::$db ?:
        $statement = $db->prepare($sql);
        $success = $statement->execute();

        if (!$success) {
            throw new PDOException;
        }


        return $statement;
    }

}


?>
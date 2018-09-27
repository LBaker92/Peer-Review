<?php

include 'DBConnector.class.php';

class DBQueryRunner {

    private static $pdo = null;

    function __construct() { }

    public function setConnection() {
        self::$pdo = DBConnector::createInstance()->getConnection();
    }

    public function executeQuery($sql) {
        self::$pdo ?: self::setConnection();
        $statement = self::$pdo->prepare($sql);
        $success = $statement->execute();

        if (!$success) {
            throw new PDOException;
        }

        return $statement;
    }

}


?>
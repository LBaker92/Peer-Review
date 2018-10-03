<?php

include_once '../lib/db/DBQueryRunner.class.php';
include_once 'TableGateway.class.php';
include_once 'Student.class.php';

class StudentTableGateway extends TableGateway {

    private static $baseSql = "SELECT * FROM students";
    private static $delimiter = '", "';

    public function __construct() { }

    public function findAll() {
        $statement = DBQueryRunner::executeQuery(self::$baseSql);
        $studentArray = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $students = array();
        foreach($studentArray as $student) {
            array_push($students, new Student($student));
        }

        if (empty($students)) {
            return;
        }
        return $students;
    }

    public function findById($id) {
        $sql = self::$baseSql . ' where id = "' . $id . '"';
        $statement = DBQueryRunner::executeQuery($sql);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return;
        }
        return new Student($result);
    }

    public function findByEmail($email) {
        $sql = self::$baseSql . ' where email = "' . $email . '"';
        $statement = DBQueryRunner::executeQuery($sql);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return;
        }

        return new Student($result);
    }

    // Clean up SQL later
    public function insert($student) {
        $sql = 'INSERT INTO students (first_name,
                                     last_name,
                                     username,
                                     email,
                                     password)
                VALUES("'
                . $student->getFirstName() . self::$delimiter
                . $student->getLastName() . self::$delimiter
                . $student->getUsername() . self::$delimiter
                . $student->getEmail() . self::$delimiter
                . $student->getPassword() . '")';
        $statement = DBQueryRunner::executeQuery($sql);
    }
}

?>
<?php

include_once 'Instructor.class.php';

class InstructorTableGateway extends TableGateway {

    private static $baseSql = "SELECT * FROM instructors";
    private static $delimiter = '", "';

    public function findAll() {
        $statement = DBQueryRunner::executeQuery(self::$baseSql);
        $instructorArray = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $instructors = array();
        foreach($instructorArray as $instructor) {
            $instructors[$instructor["id"]] = new Student($instructor);
        }
        return $instructors;
    }

    public function findById($id) {
        $sql = self::$baseSql . " where id = " . $id;
        $statement = DBQueryRunner::executeQuery($sql);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Instructor($result);
    }

    public function findByEmail($email) {
        $sql = self::$baseSql . ' where email = "' . $email . '"';
        $statement = DBQueryRunner::executeQuery($sql);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return;
        }

        return new Instructor($result);
    }

    // Clean up SQL later
    public function insert($instructor) {
        $sql = 'INSERT INTO instructors (first_name,
                                     last_name,
                                     username,
                                     email,
                                     password)
                VALUES("'
                . $instructor->getFirstName() . self::$delimiter
                . $instructor->getLastName() . self::$delimiter
                . $instructor->getUsername() . self::$delimiter
                . $instructor->getEmail() . self::$delimiter
                . $instructor->getPassword() . '")';
        $statement = DBQueryRunner::executeQuery($sql);
    }
}



?>
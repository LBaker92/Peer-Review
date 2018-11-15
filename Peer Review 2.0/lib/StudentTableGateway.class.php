<?php

class StudentTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "Students";
    }

    protected function getDomainObjectClassName()
    {
        return "Student";
    }

    protected function getOrderFields()
    {
        return "LastName,FirstName";
    }

    protected function getPrimaryKeyName()
    {
        return "StudentID";
    }

    public function findByEmail($email)
    {
        $studentArray = $this->findBy("Email = ?", $email);
        if (count($studentArray) > 0) {
            // findBy returns an array, so we return the first index
            return $studentArray[0];
        }
        else {
            return NULL;
        }
    }
}

?>
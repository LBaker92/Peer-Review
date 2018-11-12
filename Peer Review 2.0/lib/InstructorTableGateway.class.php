<?php

class InstructorTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "Instructors";
    }

    protected function getDomainObjectClassName()
    {
        return "Instructor";
    }

    protected function getOrderFields()
    {
        return "LastName,FirstName";
    }

    protected function getPrimaryKeyName()
    {
        return "InstructorID";
    }

    public function findByEmail($email)
    {
        // findBy returns an array, so we return the first index
        return $this->findBy("Email = ?", $email)[0];
    }
}

?>
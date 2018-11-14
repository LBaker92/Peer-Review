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
        $instructorArray = $this->findBy("Email = ?", $email);
        if (count($instructorArray) > 0) {
            // findBy returns an array, so we return the first index
            return $instructorArray[0];
        }
        else {
            return NULL;
        }

    }
}

?>
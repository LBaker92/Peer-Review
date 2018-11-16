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
        $sql = $this->getSelectStatement() . " WHERE Email = ?";
        return $this->dbAdapter->fetchRow($sql, $email);
    }
}

?>
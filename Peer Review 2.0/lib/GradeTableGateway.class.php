<?php

class GradeTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "Grades";
    }

    protected function getDomainObjectClassName()
    {
        return "Grade";
    }

    protected function getOrderFields()
    {
        return "EvaluationID";
    }

    protected function getPrimaryKeyName()
    {
        return "GradeID";
    }

    // Additional database querying functionality here
}

?>
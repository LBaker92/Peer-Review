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

    public function findByStudentID($studentID)
    {
        $sql = $this->getSelectStatement() . " WHERE StudentID = ?";
        return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, $studentID));
    }

    public function findByGraderID($graderID)
    {
        $sql = $this->getSelectStatement() . " WHERE GraderID = ?";
        return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, $graderID));
    }
    public function findByEvaluationID($evalID)
    {
        $sql = $this->getSelectStatement() . " WHERE EvaluationID = ?";
        return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, $evalID));
    }
}

?>
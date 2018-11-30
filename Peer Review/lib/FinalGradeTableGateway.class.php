<?php

class FinalGradeTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "FinalGrades";
    }

    protected function getDomainObjectClassName()
    {
        return "FinalGrade";
    }

    protected function getOrderFields()
    {
        return "EvaluationID";
    }

    protected function getPrimaryKeyName()
    {
        return "StudentID";
    }

    // Needs changed to also include EvaluationID
    public function findByStudentID($studentID)
    {
        $sql = $this->getSelectStatement() . " WHERE StudentID = ?";
        return $this->convertRecordsToObjects($this->dbAdapter->fetchAsArray($sql, $studentID));
    }

    public function findByEvaluationID($evalID)
    {
        $sql = $this->getSelectStatement() . " WHERE EvaluationID = ?";
        return $this->convertRecordsToObjects($this->dbAdapter->fetchAsArray($sql, $evalID));
    }

    public function update($finalGrade)
    {
        $fieldsToUpdate = array("FinalGrade" => $finalGrade->FinalGrade);
        $this->dbAdapter->update($this->getTableName(), $fieldsToUpdate,
                                 "StudentID = :studentID",
                                 array(":studentID" => $finalGrade->StudentID));
    }
}

?>
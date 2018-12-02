<?php

class EvaluationTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "Evaluations";
    }

    protected function getDomainObjectClassName()
    {
        return "Evaluation";
    }

    protected function getOrderFields()
    {
        return "Year";
    }

    protected function getPrimaryKeyName()
    {
        return "EvaluationID";
    }

    public function findByEval($eval)
    {
        $sql = $this->findBy("CourseID = ? and Section = ? and Year = ?", array(
            $eval->CourseID,
            $eval->Section,
            $eval->Year
        ))[0];
        return $sql;
    }

    public function findByEvalID($id)
    {
        $sql = $this->getSelectStatement() . " WHERE EvaluationID = ?";
        return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, $id));
    }

    public function findEvalsByInstructorID($id)
    {
        $sql = $this->getSelectStatement() . " WHERE InstructorID = ?";
        return $this->convertRecordsToObjects($this->dbAdapter->fetchAsArray($sql, $id));
    }

    public function insert($eval)
    {
        $success = $this->dbAdapter->insert($this->getTableName(), $eval->getFieldValues());
        if (!$success) {
            throw new PDOException;
        }
    }

    public function setPublishEval($evalID, $status) 
    {
        $sql = "UPDATE " . $this->getTableName() . " SET PublishEval = ? WHERE EvaluationID = ?";
        $this->dbAdapter->runQuery($sql, Array($status, $evalID));
    }
}

?>
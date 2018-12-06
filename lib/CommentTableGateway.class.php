<?php

class CommentTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "comments";
    }

    protected function getDomainObjectClassName()
    {
        return "Comment";
    }

    protected function getOrderFields()
    {
        return "EvaluationID";
    }

    protected function getPrimaryKeyName()
    {
        return "GraderID, EvaluationID";
    }

    public function findByGraderID($graderID)
    {
        $sql = $this->getSelectStatement() . " WHERE GraderID = ?";
        return $this->convertRecordsToObjects($this->dbAdapter->fetchAsArray($sql, $graderID));
    }
    public function findByEvaluationID($evalID)
    {
        $sql = $this->getSelectStatement() . " WHERE EvaluationID = ?";
        return $this->convertRecordsToObjects($this->dbAdapter->fetchAsArray($sql, $evalID));
    }

    public function findUniqueComment($graderID, $evalID)
    {
        $sql = $this->getSelectStatement() . " WHERE GraderID = ? and EvaluationID = ?";
        return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, array($graderID, $evalID)));
    }

    public function update($comment)
    {
        $fieldsToUpdate = array(
            "Comments" => $comment->Comments
        );

        $this->dbAdapter->update($this->getTableName(),
                                 $fieldsToUpdate,
                                 "GraderID = :graderID and EvaluationID = :evaluationID",
                                 array(":graderID" => $comment->GraderID,
                                        ":evaluationID" => $comment->EvaluationID
                                ));
    }
}

?>
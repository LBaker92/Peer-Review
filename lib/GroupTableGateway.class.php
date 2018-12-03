<?php

class GroupTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "groups";
    }

    protected function getDomainObjectClassName()
    {
        return "Group";
    }

    protected function getOrderFields()
    {
        return "ProjectName";
    }

    protected function getPrimaryKeyName()
    {
        return "GroupID";
    }

    public function findByLeaderEmail($leaderEmail)
    {
        $sql = $this->getSelectStatement() . " WHERE LeaderEmail = ?";
        return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, $leaderEmail));
    }
}

?>
<?php

class Group extends DomainObject
{
    static function getFieldNames()
    {
        return array("GroupID", "ProjectName", "ProjectDescription", "LeaderEmail");
    }

    public function __construct(array $data, $generateException)
    {
        parent::__construct($data, $generateException);
    }
    
}

?>
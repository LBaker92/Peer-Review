<?php

class Comment extends DomainObject
{
    static function getFieldNames()
    {
        return array("GraderID", "EvaluationID", "Comments");
    }

    public function __construct(array $data, $generateException)
    {
        parent::__construct($data, $generateException);
    }
}

?>
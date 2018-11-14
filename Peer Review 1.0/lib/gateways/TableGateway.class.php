<?php

abstract class TableGateway {

    abstract public function findAll();
    abstract public function findById($id);
    abstract public function findByEmail($email);

    abstract public function insert($row);


    // NEEDS DELETE LATER

}



?>
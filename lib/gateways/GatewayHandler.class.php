<?php

include_once '../lib/gateways/StudentTableGateway.class.php';

class GatewayHandler {

    private $studentTableGateway = null;

    public function __construct() {
        $this->studentTableGateway = new StudentTableGateway();
    }

    public function getStudentGate() { return $this->studentTableGateway; }

}

?>
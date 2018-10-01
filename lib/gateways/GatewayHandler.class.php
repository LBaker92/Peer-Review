<?php

include_once '../lib/gateways/StudentTableGateway.class.php';
include_once '../lib/gateways/InstructorTableGateway.class.php';

class GatewayHandler {

    private $studentTableGateway = null;
    private $instructorTableGateway = null;

    public function __construct() {
        $this->studentTableGateway = new StudentTableGateway();
        $this->instructorTableGateway = new InstructorTableGateway();
    }

    public function getStudentGate() { return $this->studentTableGateway; }
    public function getInstructorGate() { return $this->instructorTableGateway; }

}

?>
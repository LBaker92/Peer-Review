<?php

include_once '../lib/gateways/StudentTableGateway.class.php';
include_once '../lib/gateways/InstructorTableGateway.class.php';
include_once '../lib/gateways/AdminSettingsTableGateway.class.php';

class GatewayHandler {

    private $studentTableGateway = null;
    private $instructorTableGateway = null;
    private $adminSettingsTableGateway = null;

    public function __construct() {
        $this->studentTableGateway = new StudentTableGateway();
        $this->instructorTableGateway = new InstructorTableGateway();
        $this->adminSettingsTableGateway = new AdminSettingsTableGateway();
    }

    public function getStudentGate() { return $this->studentTableGateway; }
    public function getInstructorGate() { return $this->instructorTableGateway; }
    public function getAdminSettingsGate() { return $this->adminSettingsTableGateway; }

}

?>
<?php

include_once '../lib/gateways/UserTableGateway.class.php';

class GatewayHandler {

    private $userTableGateway = null;

    public function __construct() {
        $this->userTableGateway = new UserTableGateway();
    }

    public function getUserGate() { return $this->userTableGateway; }

}

?>
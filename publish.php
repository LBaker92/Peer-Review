<?php
include 'includes/config.inc.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION["user"]["admin"]) {
        $evalGate = new EvaluationTableGateway($dbAdapter);
        $eval = $evalGate->findByEvalID($_POST["evalID"]);
        if (!empty($eval)) {
            $evalGate->setPublishEval($eval->EvaluationID, true);
        }
        header("Location: admin/manager.php");
    }
}

?>
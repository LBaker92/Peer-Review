<?php
include 'includes/config.inc.php';
session_start();

if ($_SESSION["user"]["admin"]) {
    $evalGate = new EvaluationTableGateway($dbAdapter);
    $eval = $evalGate->findEvalsByInstructorID($_SESSION["user"]["InstructorID"])[0];
    $evalGate->setPublishEval($eval->EvaluationID, true);
    header("Location: admin/manager.php");
}

?>
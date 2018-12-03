<?php
include 'includes/config.inc.php';
session_start();

$studentGate = new StudentTableGateway($dbAdapter);
$studentGate->setCompletedEval($_SESSION["user"]["StudentID"], false);

$_SESSION["user"] = $studentGate->findById($_SESSION["user"]["StudentID"])->getFieldValues();

header("Location: student/index.php");
?>
<?php
include '../includes/helpers.inc.php';
session_start();

if (!empty($_SESSION['user'])) {
    if (!empty($_SESSION['user']['admin'])) {
        if (!$_SESSION['user']['admin']) {
            header('Location: ../student/index.php');
            exit();
        }
    }
}
$_SESSION["user"] = getUserInfo("Instructor", $_SESSION["user"]["Email"]);
$_SESSION["user"]["admin"] = true;

$evalGate = new EvaluationTableGateway($dbAdapter);
$evals = $evalGate->findEvalsByInstructorID($_SESSION["user"]["InstructorID"]);

if (count($evals) > 0) {
    header("Location: manager.php");
    exit();
}
else {
    header("Location: creator.php");
    exit();
}

?>

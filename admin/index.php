<?php
include '../includes/helpers.inc.php';
session_start();

if (!empty($_SESSION['user'])) {
    if (!$_SESSION['user']['admin']) {
        header('Location: student/index.php');
        exit();
    }
}

$evalGate = new EvaluationTableGateway($dbAdapter);
$evals = $evalGate->findEvalsByInstructorID($_SESSION["user"]["InstructorID"]);

// This wont work for more than 1 evaluation.
// Later, we can add a selection to choose which course to publish
if (count($evals) > 0) {
    header("Location: manager.php");
    exit();
}
else {
    header("Location: creator.php");
    exit();
}

?>

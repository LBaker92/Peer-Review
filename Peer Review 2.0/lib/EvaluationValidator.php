<?php
include "../includes/helpers.inc.php";
session_start();

unset($_SESSION["errors"]["input"]);

$groupGate = new GroupTableGateway($dbAdapter);
$studentGate = new StudentTableGateway($dbAdapter);
$criteriaGate = new GradeCriteriaTableGateway($dbAdapter);

$group = $groupGate->findById($_SESSION["user"]["GroupID"]);
$students = $studentGate->findByGroupID($group->GroupID);
$criterias = $criteriaGate->findAll();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    for ($i = 0; $i < count($_POST); $i++) {
        if (empty($_POST[$i])) {
            $_SESSION["errors"]["input"] = "You missed a field when grading.";
            header("Location: ../student/evaluation.php");
            exit();
        }
    }

}

?>
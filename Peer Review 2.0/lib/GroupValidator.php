<?php
include '../includes/config.inc.php';
session_start();
?>

<?php
    $groupGate = new GroupTableGateway($dbAdapter);
    $groupArray = array(
        "ProjectName" => $_POST["title"],
        "ProjectDescription" => $_POST["description"],
        "LeaderEmail" => $_SESSION["user"]["Email"]
    );
    $group = new Group($groupArray, false);
    $groupGate->insert($group);
    $group = $groupGate->findBy("ProjectName = ?", Array($_POST["title"]))[0];

    $studentGate = new StudentTableGateway($dbAdapter);
    foreach($_POST["memberIDs"] as $memberID) {
       $student= $studentGate->findByID($memberID); 
       $studentGate->setGroupID($student->StudentID, $group->GroupID);
    }

    header("Location: ../student/index.php");
?>
<?php
include "../includes/helpers.inc.php";
session_start();

unset($_SESSION["errors"]["input"]);

$groupGate = new GroupTableGateway($dbAdapter);
$studentGate = new StudentTableGateway($dbAdapter);
$criteriaGate = new GradeCriteriaTableGateway($dbAdapter);
$gradeGate = new GradeTableGateway($dbAdapter);

$group = $groupGate->findById($_SESSION["user"]["GroupID"]);
$students = $studentGate->findByGroupID($group->GroupID);
$criterias = $criteriaGate->findAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = false;
    foreach($_POST as $grades) {
        if ($error) {
            break;
        }
        // Loop through the single values stored in each person's evaluation
        foreach($grades as $grade) {
            if (empty($grade)) {
                $_SESSION["errors"]["input"] = "You left a field empty.";
                header("Location: ../student/evaluation.php");
                $error = true;
                break;
            }
            if ($grade < 0 || $grade > 10) {
                $_SESSION["errors"]["input"] = "Grade values must be between 0-10";
                header("Location: ../student/evaluation.php");
                $error = true;
                break;
            }
        }
    }

    foreach($students as $student) {
        $gradedArray = $gradeGate->findByGraderID($_SESSION["user"]["StudentID"]);
        $grade = array(
            "Participation" => $_POST[$student->StudentID]["Participation"],
            "Contribution" => $_POST[$student->StudentID]["Contribution"],
            "Attendance" => $_POST[$student->StudentID]["Attendance"],
            "Supportiveness" => $_POST[$student->StudentID]["Supportiveness"],
            "Communication" => $_POST[$student->StudentID]["Communication"],
            "StudentID" => $student->StudentID,
            "GraderID" => $_SESSION["user"]["StudentID"],
            "EvaluationID" => $student->EvaluationID
        );

        $grade = new Grade($grade, false);
        
        // If the grader hasn't graded anybody yet
        if(empty($gradedArray)) {
            $gradeGate->insert($grade);
        }
        else {
            $found = false;
            foreach($gradedArray as $graded) {
                // If the studentID on the grade to insert is already graded
                if ($grade->StudentID == $graded->StudentID) {
                    $found = true;
                }
            }

            if (!$found) {
                $gradeGate->insert($grade);
            }
            else {
                $gradeGate->update($grade);
            }
        }
    }
    //REDIRECT TO GRADE DISPLAY SCREEN
}

?>
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
    $gradeValues = array();
    foreach($_POST as $grades) {
        // Loop through the single values stored in each person's evaluation
        foreach($grades as $grade) {
            if (empty($grade || $grade < 0 || $grade > 10)) {
                $_SESSION["errors"]["input"] = "Make sure to fill all fields with values between 0 - 10";
            }
            if ($grade < 0 || $grade > 10) {
                array_push($gradeValues, "");
            }
            else {
                array_push($gradeValues, $grade);
            }
        }
    }

    $_SESSION["grades"] = $gradeValues;
    if (!empty($_SESSION["errors"]["input"])) {
        header("Location: ../student/evaluation.php");
        exit();
    }
    
    // Insert each student's grade into the Grade table
    // Also insert/update final grade 
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
        
        $grades = $gradeGate->findBy("StudentID = ? and EvaluationID = ?", array($student->StudentID, $student->EvaluationID));

        $gradeAvgTotal = 0;
        $gradeAvgMax = count($grades) * 10;
        $numOfGrades = count($grades);
        foreach ($grades as $grade) {
            // Access the fieldValues array inside the grade object.
            $fields = $grade->getFieldValues();
            // Sum up all of the values in each row of the student's grades
            $sumOfGrades = 0;
            foreach ($criterias as $criteria) {
                $sumOfGrades += $fields[$criteria->Title];
            }
            $rowAvg = $sumOfGrades / count($criterias);
            $gradeAvgTotal += $rowAvg;
        }

        $gradeSummary = $gradeAvgTotal / $gradeAvgMax;
        $gradeSummary *= 100;

        $finalGradeGate = new FinalGradeTableGateway($dbAdapter);
        $finalGrade = new FinalGrade(array("StudentID" => $student->StudentID,
                                           "Email" => $student->Email,
                                           "EvaluationID" => $student->EvaluationID,
                                           "FinalGrade" => $gradeSummary), false);
        
        $oldFinalGrade = $finalGradeGate->findByStudentID($student->StudentID);

        // If a final grade already exists
        if (!empty($oldFinalGrade) > 0) {
            $finalGradeGate->update($finalGrade);
        }
        else {
            $finalGradeGate->insert($finalGrade);
        }
    }

    $studentGate->setCompletedEval($_SESSION["user"]["StudentID"], 1);
    header("Location: ../student/grade.php");
}

?>
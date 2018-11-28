<?php

// FINAL GRADES SHOULD BE GETTING SENT SOMEWHERE TO GIVE TO THE TEACHER

include "../includes/helpers.inc.php";
session_start();

$studentGate = new StudentTableGateway($dbAdapter);
$gradeGate = new GradeTableGateway($dbAdapter);
$criteriaGate = new GradeCriteriaTableGateway($dbAdapter);

$criterias = $criteriaGate->findAll();
$students = $studentGate->findByGroupID($_SESSION["user"]["GroupID"]);
$grades = $gradeGate->findBy("StudentID = ? and EvaluationID = ?", array($_SESSION["user"]["StudentID"], 
                                                                         $_SESSION["user"]["EvaluationID"]));

$gradeTotal = 0;
$sumOfGrades = 0;
$gradeMax = count($grades) * 10;
$numOfGrades = count($grades);
foreach ($grades as $grade) {
    // Access the fieldValues array inside the grade object.
    $fields = $grade->getFieldValues();
    foreach ($criterias as $criteria) {
        $sumOfGrades += $fields[$criteria->Title];
    }
    $gradeAvg = $sumOfGrades / count($criterias);

    $gradeTotal += $gradeAvg;
}
$gradeSummary = $gradeTotal / $gradeMax * 100;

$letterGrade = "";
if ($gradeSummary >= 100) { $letterGrade = "A+"; }
else if ($gradeSummary >= 90 && $gradeSummary < 100) { if ($gradeSummary == 90) { $letterGrade = "A-"; } else { $letterGrade = "A"; } }
else if ($gradeSummary >= 80 && $gradeSummary < 90) { if ($gradeSummary == 80) { $letterGrade = "B-"; } else if ($gradeSummary == 89) { $letterGrade = "B+"; } else { $letterGrade = "B"; } }
else if ($gradeSummary >= 70 && $gradeSummary < 80) { if ($gradeSummary == 70) { $letterGrade = "C-"; } else if ($gradeSummary == 79) { $letterGrade = "C+"; } else { $letterGrade = "C"; } }
else if ($gradeSummary >= 60 && $gradeSummary < 70) { if ($gradeSummary == 60) { $letterGrade = "D-"; } else if ($gradeSummary == 69) { $letterGrade = "D+"; } else { $letterGrade = "D"; } }
else { $letterGrade = "F"; }

// database table FinalGrades [ StudentID | EvaluationID | FinalGrade ]
// pull all current final grades for this eval
// Check to see if this student is already here
// if he isnt there add him to the CSV file

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en">
    <title>Evaluation</title>
    <?php insertLinks(); ?>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php insertNavbar(); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <h3 class="mt-5">Your current grade: </h3>
                <h1 class="display-1 font-weight-bold d-inline-block"><?= $letterGrade ?></h1>
                <h3 class="d-inline-block"><?= $gradeSummary . "%" ?></h3>
                <?php if (count($grades) < count($students)) { ?>
                <p>* This is not your final grade.
                <br/>
                <strong><?= count($grades) ?>/<?= count($students) ?></strong> of your group members have finished their evaluations.</p>
                <?php } ?>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12 text-center mt-3">
                <p><a href="../reevaluate.php">Click here</a> to reevaluate your group members.</p>
            </div>
        </div> -->
    </div>
</body>
</html>
<?php
include '../includes/helpers.inc.php';
session_start();

if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['admin']) {
        header('Location: ../admin/index.php');
        exit();
    }
    else {
        $userInDB = getUserInfo("Student", $_SESSION["user"]["Email"]);
        if (!empty($userInDB)) {
            $_SESSION["user"] = $userInDB;
            $_SESSION["user"]["admin"] = false;
        }
        else {
            session_destroy();
            header("Location: ../login.php");
            exit();
        }
    }
}
else {
    header("Location: ../login.php");
    exit();
}

$_SESSION["user"] = getUserInfo("Student", $_SESSION["user"]["Email"]);
$_SESSION["user"]["admin"] = false;

$evalGate = new EvaluationTableGateway($dbAdapter);
$eval = $evalGate->findByEvalID($_SESSION["user"]["EvaluationID"]);

// If the evaluation has not been published give the student an error message
if (!$eval->PublishEval) {
    $_GET["error"] = "not published";
}

$studentGate = new StudentTableGateway($dbAdapter);
$gradeGate = new GradeTableGateway($dbAdapter);
$criteriaGate = new GradeCriteriaTableGateway($dbAdapter);
$finalGradeGate = new FinalGradeTableGateway($dbAdapter);

$criterias = $criteriaGate->findAll();

// Get all of the currently logged in student's grades
$grades = $gradeGate->findBy("StudentID = ? and EvaluationID = ?", array($_SESSION["user"]["StudentID"], $_SESSION["user"]["EvaluationID"]));

$students = $studentGate->findByGroupID($_SESSION["user"]["GroupID"]);
$finalGrade = $finalGradeGate->findByStudentID($_SESSION["user"]["StudentID"]);

$letterGrade = "";
if ($finalGrade->FinalGrade >= 100) { $letterGrade = "A+"; }
else if ($finalGrade->FinalGrade >= 90 && $finalGrade->FinalGrade < 100) { if ($finalGrade->FinalGrade == 90) { $letterGrade = "A-"; } else { $letterGrade = "A"; } }
else if ($finalGrade->FinalGrade >= 80 && $finalGrade->FinalGrade < 90) { if ($finalGrade->FinalGrade == 80) { $letterGrade = "B-"; } else if ($finalGrade->FinalGrade == 89) { $letterGrade = "B+"; } else { $letterGrade = "B"; } }
else if ($finalGrade->FinalGrade >= 70 && $finalGrade->FinalGrade < 80) { if ($finalGrade->FinalGrade == 70) { $letterGrade = "C-"; } else if ($finalGrade->FinalGrade == 79) { $letterGrade = "C+"; } else { $letterGrade = "C"; } }
else if ($finalGrade->FinalGrade >= 60 && $finalGrade->FinalGrade < 70) { if ($finalGrade->FinalGrade == 60) { $letterGrade = "D-"; } else if ($finalGrade->FinalGrade == 69) { $letterGrade = "D+"; } else { $letterGrade = "D"; } }
else { $letterGrade = "F"; }

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
            <?php if (empty($_GET["error"])) { ?>
                <?php if (count($grades) < count($students)) { ?>
                    <h3 class="mt-5">Your current grade: </h3>
                    <h1 class="mt-3 d-inline-block display-1 font-weight-bold"><?= $letterGrade ?></h1>
                    <h3 class="display-4">(<?= $finalGrade->FinalGrade . "%" ?>)</h3>
                    <p class="text-center">
                        <br/>
                        <strong>This is not your final grade.</strong>
                        <br/>
                        <strong><?= count($grades) ?>/<?= count($students) ?></strong> of your group members have finished their evaluations.
                        <br/>
                        Your final grade will be determined when all group members have finished their evaluations.
                    </p>
                <?php } else { ?>
                    <h3 class="mt-5">Your final grade: </h3>
                    <h1 class="mt-3 d-inline-block display-1 font-weight-bold"><?= $letterGrade ?></h1>
                    <h3 class="display-4">(<?= $finalGrade->FinalGrade . "%" ?>)</h3>
                <?php } ?>
            <?php } else { ?>
                    <h3>The professor has not published the evaulations yet.</h3>
            <?php } ?>
            </div>
        </div>
    <?php if (!$eval->PublishEval) { ?>
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                <p class="mt-5">
                    Did you make a mistake while grading? 
                    <br/>
                </p>
                <a href="../reevaluate.php">Resubmit Evaluation</a>
            </div>
        </div>
    <?php } ?>
    </div>
</body>
</html>
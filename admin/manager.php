<?php
include '../includes/helpers.inc.php';
session_start();

if (!empty($_SESSION['user'])) {
    // Redirect a student back to the student page
    if (!$_SESSION['user']['admin']) {
        header('Location: ../student.php');
        exit();
    }
}

$evalGate = new EvaluationTableGateway($dbAdapter);
$eval = $evalGate->findEvalsByInstructorID($_SESSION["user"]["InstructorID"])[0];

if (!$eval) {
    header("Location: creator.php?error=" . urlencode("There were no evaluations found in the database."));
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <?php insertLinks(); ?>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php insertAdminNavbar(); ?>
    <div class="container">
        <div class="row py-5"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
            <?php if ($eval->PublishEval) { ?>
                <button class="btn btn-dark btn-lg" id="reeval"><a href="../unpublish.php">Hide Evaluation</a></button>
            <?php } else { ?>
                <button class="btn btn-dark btn-lg" id="reeval"><a href="../publish.php">Publish Evaluation</a></button>
            <?php } ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script src="js/validation.js"></script>
</body>
</html>
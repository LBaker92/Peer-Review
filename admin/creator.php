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
else {
    header("Location: ../login.php");
    exit();
}
$_SESSION["user"] = getUserInfo("Instructor", $_SESSION["user"]["Email"]);
$_SESSION["user"]["admin"] = true;
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
        <div class="row mt-3">
        <?php if (!empty($_GET["error"])) { ?>
            <div class="alert alert-danger mx-auto" role="alert">
                <strong>Oh snap!</strong> <?= $_GET["error"] ?>
            </div>
        <?php } ?>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="needs-validation" action="../lib/EvaluationCreator.php" method="post" enctype="multipart/form-data" novalidate>
                    <h4 class="text-center mb-3">Course Evaluation</h4>
                    <div class="form-group">
                        <Label><strong>Course Roster</strong></Label>
                        <input class="form-control-file" type="file" name="roster" required>
                        <p class="form-alert pt-1">* File must be a CSV file. ( .csv )</p>
                    </div>
                    <div class="form-group">
                        <Label><strong>Course ID</strong></Label>
                        <input type="text" class="form-control" name="course_id" placeholder="CS-101" required>
                    </div>
                    <div class="form-group">
                        <Label><strong>Course Title</strong></Label>
                        <input type="text" class="form-control" name="title" placeholder="Intro to Database System Design" required>
                    </div>
                    <div class="form-group">
                        <Label><strong>Section</strong></Label>
                        <input type="text" class="form-control" name="section" placeholder="001" required>
                    </div>
                    <div class="form-group">
                        <Label><strong>Semester</strong></Label>
                        <input type="text" class="form-control" name="semester" placeholder="Fall" required>
                    </div>
                    <div class="form-group">
                        <Label><strong>Year</strong></Label>
                        <input type="text" class="form-control" name="year" placeholder="2018" required>
                    </div>
                    <div class="form-group pt-2 text-center">
                        <button type="submit" class="btn btn-lg btn-dark btn-block">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script src="../js/validation.js"></script>
</body>
</html>
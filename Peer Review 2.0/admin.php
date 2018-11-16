<?php
include 'includes/config.inc.php';
include 'includes/helpers.inc.php';
session_start();

if (!empty($_SESSION['user'])) {
    // Redirect a student back to the student page
    if (!$_SESSION['user']['admin']) {
        header('Location: student.php');
    }
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
</head>
<body>
    <?php insertNavbar(); ?>
    <div class="container">
        <div class="row py-5"></div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="lib/EvaluationCreator.php" method="post" novalidate>
                    <h4 class="text-center py-3">Course Evaluation</h4>
                    <div class="form-group">
                        <Label><strong>Course Roster</strong></Label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile"></label>
                            <p class="form-alert text-right pt-1">* File must be a CSV file. ( .csv )</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <Label><strong>Course ID</strong></Label>
                        <input type="text" class="form-control" name="course_id" required>
                    </div>
                    <div class="form-group">
                        <Label><strong>Course Title</strong></Label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <Label><strong>Section</strong></Label>
                        <input type="text" class="form-control" name="section" required>
                    </div>
                    <div class="form-group">
                        <Label><strong>Semester</strong></Label>
                        <input type="text" class="form-control" name="semester" required>
                    </div>
                    <div class="form-group">
                        <Label><strong>Year</strong></Label>
                        <input type="text" class="form-control" name="year" required>
                    </div>
                    <div class="form-group pt-2 text-center">
                        <button type="submit" class="btn btn-lg btn-dark btn-block">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <script src="js/validation.js"></script>
</body>
</html>
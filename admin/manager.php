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
$_SESSION["user"] = getUserInfo("Instructor", $_SESSION["user"]["Email"]);
$_SESSION["user"]["admin"] = true;

$evalGate = new EvaluationTableGateway($dbAdapter);
$evals = $evalGate->findEvalsByInstructorID($_SESSION["user"]["InstructorID"]);

$unpublishedEvals = 0;
$publishedEvals = 0;
foreach($evals as $eval) {
    if (!$eval->PublishEval) {
        $unpublishedEvals++;
    }
    else {
        $publishedEvals++;
    }
}

if (empty($evals)) {
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
                <?php if ($unpublishedEvals > 0) { ?>
                <h3 class="mb-3">Publish Course</h3>
                <form action="../publish.php" method="post">
                    <div class="form-group">
                        <select class="form-control" name="evalID" size="1">
                        <?php foreach($evals as $eval) { ?>
                            <?php if (!$eval->PublishEval) { ?>
                            <option value="<?= $eval->EvaluationID ?>"><?= $eval->CourseID . " | " . $eval->CourseTitle ?></option>
                            <?php  } ?>
                        <?php  } ?>
                        </select>
                    </div>
                    <button class="btn btn-lg btn-dark" type="submit">Publish</button>
                </form>
                <?php } else { ?>
                <h4>All evaluations have been published.</h4>
                <?php } ?>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <?php if ($publishedEvals > 0) { ?>
                <h3 class="mb-3">Unpublish Course</h3>
                <form action="../unpublish.php" method="post">
                    <div class="form-group">
                        <select class="form-control" name="evalID" size="1">
                        <?php foreach($evals as $eval) { ?>
                            <?php if ($eval->PublishEval) { ?>
                            <option value="<?= $eval->EvaluationID ?>"><?= $eval->CourseID . " | " . $eval->CourseTitle ?></option>
                            <?php  } ?>
                        <?php  } ?>
                        </select>
                    </div>
                    <button class="btn btn-lg btn-dark" type="submit">Unpublish</button>
                </form>
                <?php } else { ?>
                <h4>There are no evaluations to unpublish.</h4>
                <?php } ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script src="js/validation.js"></script>
</body>
</html>
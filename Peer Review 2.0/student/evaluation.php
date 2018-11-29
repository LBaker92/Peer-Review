<?php
include "../includes/helpers.inc.php";
session_start();

if (!empty($_SESSION["user"]["graded"])) {
    header("Location: grade.php");
    exit();
}

$groupGate = new GroupTableGateway($dbAdapter);
$studentGate = new StudentTableGateway($dbAdapter);
$criteriaGate = new GradeCriteriaTableGateway($dbAdapter);
$gradeGate = new GradeTableGateway($dbAdapter);

$group = $groupGate->findById($_SESSION["user"]["GroupID"]);
$students = $studentGate->findByGroupID($group->GroupID);
$criterias = $criteriaGate->findAll();
$graded = $gradeGate->findByGraderID($_SESSION["user"]["StudentID"]);

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
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 table-responsive-md">
                <h2 class="text-center mb-4">Evaluations</h2>
                <form class="needs-validation" action="../lib/GradeValidator.php" method="post" novalidate>
                <?php if (!empty($_SESSION["errors"]["input"])) { ?>
                    <p class="form-alert">* <?= $_SESSION["errors"]["input"] ?></p>
                <?php } ?>
                    <h4><?= $group->ProjectName ?></h4>
                    <p><?= $group->ProjectDescription ?></p>
                    <p><strong>* You must enter values between 0-10.</strong></p>
                    <?php foreach($students as $student) { ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <?php if ($student->Email == $group->LeaderEmail) { ?>
                                    <th colspan="<?= count($criterias) ?>"><i class="fas fa-crown"></i> <?= $student->getFullName(); ?> ( Group Leader )</th>
                                    <?php } else if ($student->StudentID == $_SESSION["user"]["StudentID"]) { ?>
                                    <th style="background: rgba(255,0,0,.25); font-style: italic;" colspan="<?= count($criterias) ?>">* <?= $student->getFullName(); ?> ( You )</th>
                                    <?php } else { ?>
                                    <th colspan="<?= count($criterias) ?>"><?= $student->getFullName(); ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php foreach($criterias as $criteria) { ?>
                                    <td><?= $criteria->Title ?></td>
                                <?php } ?>
                                </tr>
                                <?php foreach($criterias as $criteria) { ?>
                                    <td><small><?= $criteria->Description ?></small></td>
                                <?php } ?>
                                </tr>
                                <tr>
                                <?php foreach($criterias as $criteria) { ?>
                                <?php   if (!empty($_SESSION["errors"]["input"])) { ?>
                                    <td>
                                    <input class="form-control is-invalid" type="number" 
                                            name="<?= $student->StudentID ?>[<?= $criteria->Title ?>]" 
                                            min="0" max="10" placeholder="Value between 0-10">
                                    </td>
                                  <?php } else { ?>
                                    <td><input class="form-control" 
                                                type="number" name="<?= $student->StudentID ?>[<?= $criteria->Title ?>]" 
                                                min="0" max="10" pplaceholder="Value between 0-10"></td>
                                    <?php } ?>
                                <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-lg btn-block btn-dark mt-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
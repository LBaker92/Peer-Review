<?php
include "../includes/helpers.inc.php";
session_start();

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
            <div class="col-md-0"></div>
            <div class="col-md-12 table-responsive-md">
                <h2 class="text-center mb-4">Evaluations</h2>
                <form class="needs-validation" action="../lib/GradeValidator.php" method="post" novalidate>
                <?php if (!empty($_SESSION["errors"]["input"])) { ?>
                    <p class="form-alert">* <?= $_SESSION["errors"]["input"] ?></p>
                <?php } ?>
                    <?php foreach($students as $student) { ?>
                    <?php
                            $alreadyGraded = false;
                            foreach($grades as $grade) {
                                if ($grade->StudentID == $student->StudentID) {
                                    
                                }
                            }
                    ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="<?= count($criterias) ?>"><?= $student->getFullName(); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php foreach($criterias as $criteria) { ?>
                                    <td><?= $criteria->Title ?></td>
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
                                  <?php } else {?>
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
            <div class="col-md-0"></div>
        </div>
    </div>
</body>
</html>
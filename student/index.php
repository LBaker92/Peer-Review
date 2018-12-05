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

    // If user is already in a group
    if (!empty($_SESSION["user"]["GroupID"])) {
        if ($_SESSION["user"]["CompletedEval"]) {
            header("Location: grade.php");
            exit();
        }
        else {
            header("Location: evaluation.php");
            exit();
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php insertNavbar(); ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h3 class="mb-4 text-center">Create Your Group</h3>
                <form class="needs-validation" action="../lib/GroupValidator.php" method="post" novalidate>
                    <?php if (!empty($_SESSION["errors"]["title"])) { ?>
                    <div class="form-group">
                        <label for="group-name"><strong>Project Title</strong></label>
                        <input class="form-control is-invalid" type="text" name="title" placeholder="Online Book Store" required>
                        <div class="form-alert">* <?= $_SESSION["errors"]["title"] ?></div>
                    </div>
                    <?php } else {?>
                        <div class="form-group">
                        <label for="group-name"><strong>Project Title</strong></label>
                        <input class="form-control" type="text" name="title" placeholder="Online Book Store" required>
                    </div>
                    <?php } ?>
                    <?php if (!empty($_SESSION["errors"]["description"])) { ?>
                    <div class="form-group">
                        <label><strong>Project Description</strong></label>
                        <textarea class="form-control is-invalid" name="description" rows="5" placeholder="What is your project about?" required></textarea>
                        <div class="form-alert">* <?= $_SESSION["errors"]["description"] ?></div>
                    </div>
                    <?php } else { ?>
                        <div class="form-group">
                        <label><strong>Project Description</strong></label>
                        <textarea class="form-control" name="description" rows="5" placeholder="What is your project about?" required></textarea>
                    </div>
                    <?php } ?>
                    <?php if (!empty($_SESSION["errors"]["leader"])) { ?>
                    <div class="form-group">
                        <label><strong>Leader's Email</strong></label>
                        <input class="form-control is-invalid" type="email" name="leader" placeholder="john@kent.edu">
                        <div class="form-alert">* <?= $_SESSION["errors"]["leader"] ?></div>
                    </div>
                    <?php } else {?>
                    <div class="form-group">
                        <label><strong>Leader's Email</strong></label>
                        <input class="form-control" type="email" name="leader" placeholder="john@kent.edu">
                    </div>
                    <?php } ?>
                    <?php if (!empty($_SESSION["errors"]["memberIDs"])) { ?>
                    <div class="form-group">
                        <label><strong>Group Members</strong></label>
                        <small class="d-block">* Hold ctrl / cmd and click to select more than one member.</small>
                        <small class="d-block">* Do not exceed 5 group members.</small>
                        <?php insertGrouplessStudents(); ?>
                        <div class="form-alert">* <?= $_SESSION["errors"]["memberIDs"] ?></div>
                    </div>
                    <?php } else if (!empty($_SESSION["errors"]["included"])) { ?>
                    <div class="form-group">
                        <label><strong>Group Members</strong></label>
                        <small class="d-block">* Hold ctrl / cmd and click to select more than one member.</small>
                        <small class="d-block">* Do not exceed 5 group members.</small>
                        <?php insertGrouplessStudents(); ?>
                        <div class="form-alert">* <?= $_SESSION["errors"]["included"] ?></div>
                    </div>
                    <?php } else { ?>
                        <div class="form-group">
                        <label><strong>Group Members</strong></label>
                        <small class="d-block">* Hold ctrl / cmd and click to select more than one member.</small>
                        <small class="d-block">* Do not exceed 5 group members.</small>
                        <?php insertGrouplessStudents(); ?>
                    </div>
                    <?php } ?>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script src="../js/validation.js"></script>
</body>
</html>
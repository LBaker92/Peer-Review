<?php
include '../includes/helpers.inc.php';
session_start();

if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['admin']) {
        // Redirect an admin back to the admin page
        header('Location: ../admin/index.php');
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
    <div class="container">
        <div class="row py-5">
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h3 class="mb-4 text-center">Create Your Group</h3>
                <form class="needs-validation" action="../lib/GroupValidator.php" method="post" novalidate>
                    <div class="form-group">
                        <label for="group-name"><strong>Project Title</strong></label>
                        <input class="form-control" type="text" name="title" placeholder="Online Book" required>
                    </div>
                    <div class="form-group">
                        <label><strong>Project Description</strong></label>
                        <textarea class="form-control" name="description" rows="5" placeholder="What is your project about?" required></textarea>
                    </div>
                    <div class="form-group">
                        <label><strong>Group Members</strong></label>
                        <p class="form-alert">* Hold ctrl / cmd and click to select more than one member.</p>
                        <div class="text-center">
                            <?php insertGrouplessStudents(); ?>
                        </div>
                    </div>
                    <div class="form-group pt-2 text-center">
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
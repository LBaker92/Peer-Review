<?php 
include 'config.inc.php'; 
?>

<?php function insertLinks() { ?>
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php } ?>

<?php function insertAdminNavbar() { ?>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="http://baikal.medianet.cs.kent.edu">Peer Review</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_content" aria-controls="nav_content" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav_content">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="http://baikal.medianet.cs.kent.edu/admin/creator.php">Create Evaluation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://baikal.medianet.cs.kent.edu/admin/manager.php">Evaluation Manager</a>
                        </li>
                </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="http://baikal.medianet.cs.kent.edu/criteria.php">Criteria Details</a>
                        </li>
                        <p class="my-auto">|</p>
                        <li class="nav-item">
                            <a class="nav-link" href="http://baikal.medianet.cs.kent.edu/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
<?php } ?>

<?php function insertNavbar() { ?>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="http://baikal.medianet.cs.kent.edu">Peer Review</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_content" aria-controls="nav_content" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav_content">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="http://baikal.medianet.cs.kent.edu/student/grade.php">View Grade</a>
                        </li>
                </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="http://baikal.medianet.cs.kent.edu/criteria.php">Criteria Details</a>
                        </li>
                        <p class="my-auto">|</p>
                        <li class="nav-item">
                            <a class="nav-link" href="http://baikal.medianet.cs.kent.edu/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
<?php } ?>

<?php function insertGrouplessStudents() { ?>
    <?php $dbAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS)); ?>
    <?php $studentGate = new StudentTableGateway($dbAdapter); ?>
    <?php $students = $studentGate->findby("GroupID IS NULL"); ?>
    <div class="row">
        <?php
            $done = false;
            $index = 0;
            $numOfCols = (int)(count($students));
            while(!$done) {
        ?>
            <div class="col-md-3">
                <select class="custom-select mb-2" name="memberIDs[]" size="10" multiple>
                <?php for($j = 0; $j < 10; $j++) { ?>
                <?php if ($index == count($students)) { // We printed all students
                    $done = true; 
                    break; }
                ?>
                    <option value="<?= $students[$index]->StudentID ?>"><?= $students[$index]->getFullName(); ?></option>
                <?php $index++; ?>
                <?php } ?>
                </select>
            </div>
        <?php } ?>
    </div>
<?php } ?>


<?php

function getUserInfo($type, $email)
{
    $class = $type . "TableGateway";
    if (class_exists($class)) {
        $dbAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));
        $gate = new $class($dbAdapter);
        $user = $gate->findByEmail($email);
        if ($user) {
            return $user->getFieldValues();
        }
        else {
            return null;
        }
    }
}

?>
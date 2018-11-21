<?php include 'config.inc.php'; ?>

<?php function insertLinks() { ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php } ?>

<?php function insertNavbar() { ?>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Peer Review</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_content" aria-controls="nav_content" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav_content">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Course Evaluation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manager.php">Group Manager</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">TEST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">TEST</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Logout</a>
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
    <?php
        $index = 0;
        $numOfCols = (int)(count($students) / 10);
        for($i = 0; $i < $numOfCols; $i++) {
    ?>
            <select class="custom-select mx-2" name="memberIDs[]" size="10" multiple>
            <?php for($j = 0; $j < 10; $j++) { ?>
                <option value="<?= $students[$index]->StudentID ?>"><?= $students[$index]->getFullName(); ?></option>
            <?php $index++; ?>
            <?php } ?>
            </select>
    <?php
        }
    ?>
<?php } ?>
<?php
include 'includes/config.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gateway Tester</title>
</head>
<body>
    <h1>Gateway Tester</h1>
    <?php
        echo '<h1/>';
        echo '<h2>InstructorTableGateway Tests';
        $instructorGate = new InstructorTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $instructors = $instructorGate->findAll();
        foreach ($instructors as $instructor) {
            print_r($instructor);
            echo '<br/>';
        }

        echo '<h3>findByEmail("lbaker38@kent.edu")</h3>';
        $instructor = $instructorGate->findByEmail('lbaker38@kent.edu');
        print_r($instructor);

        echo '<h1/>';
        echo '<h2>StudentTableGateway Tests';
        $studentGate = new StudentTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $students = $studentGate->findAll();
        foreach ($students as $student) {
            print_r($student);
            echo '<br/>';
        }

        echo '<h3>findByEmail("lbaker38@kent.edu")</h3>';
        $student = $studentGate->findByEmail('lbaker38@kent.edu');
        print_r($student);

        echo '<h1/>';
        echo '<h2>GroupTableGateway Tests';
        $groupGate = new GroupTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $groups = $groupGate->findAll();
        foreach ($groups as $group) {
            print_r($group);
            echo '<br/>';
        }

        echo '<h1/>';
        echo '<h2>GradeCriteriaTableGateway Tests';
        $gradecriteriaGate = new GradeCriteriaTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $gradecriterias = $gradecriteriaGate->findAll();
        foreach ($gradecriterias as $gradecriteria) {
            print_r($gradecriteria);
            echo '<br/>';
        }
    ?>
</body>
</html>
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
        echo '<h2>InstructorTableGateway Tests';
        $instructorGate = new InstructorTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $instructors = $instructorGate->findAll();
        foreach ($instructors as $instructor) {
            print_r($instructor);
            echo '<br/>';
        }

        echo '<h3>findByID("1")</h3>';
        $instructor = $instructorGate->findByID('1');
        print_r($instructor);

        echo '<h3>findByEmail("lbaker38@kent.edu")</h3>';
        $instructor = $instructorGate->findByEmail('lbaker38@kent.edu');
        print_r($instructor);

        echo "<br/>";
        echo "<br/>";
        echo "<br/>";

        echo '<h2>StudentTableGateway Tests';
        $studentGate = new StudentTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $students = $studentGate->findAll();
        foreach ($students as $student) {
            print_r($student);
            echo '<br/>';
        }

        echo '<h3>findByID("1")</h3>';
        $student = $studentGate->findByID('1');
        print_r($student);

        echo '<h3>findByEmail("johndoe@kent.edu")</h3>';
        $student = $studentGate->findByEmail('johndoe@kent.edu');
        print_r($student);

        echo "<br/>";
        echo "<br/>";
        echo "<br/>";

        echo '<h2>GroupTableGateway Tests';
        $groupGate = new GroupTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $groups = $groupGate->findAll();
        foreach ($groups as $group) {
            print_r($group);
            echo '<br/>';
        }

        echo '<h3>findByLeaderEmail("johndoe@kent.edu")</h3>';
        $group = $groupGate->findByLeaderEmail("johndoe@kent.edu");
        print_r($group);

        echo "<br/>";
        echo "<br/>";
        echo "<br/>";

        echo '<h2>GradeCriteriaTableGateway Tests';
        $gradecriteriaGate = new GradeCriteriaTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $gradecriterias = $gradecriteriaGate->findAll();
        foreach ($gradecriterias as $gradecriteria) {
            print_r($gradecriteria);
            echo '<br/>';
        }

        echo '<h3>findByID("Participation")</h3>';
        $criteria = $gradecriteriaGate->findByID("Participation");
        print_r($criteria);
        echo "<br/>";

        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        
        echo '<h2>GradeTableGateway Tests';
        $gradeGate = new GradeTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $grades = $gradeGate->findAll();
        foreach ($grades as $grade) {
            print_r($grade);
            echo '<br/>';
        }

        echo '<h3>findByStudentID(1)</h3>';
        $grade = $gradeGate->findByStudentID(1);
        print_r($grade);
        echo "<br/>";

        echo '<h3>findByGraderID(2)</h3>';
        $grade = $gradeGate->findByGraderID(2);
        print_r($grade);
        echo "<br/>";

        echo '<h3>findByEvaluationID(1)</h3>';
        $grade = $gradeGate->findByEvaluationID(1);
        print_r($grade);
        echo "<br/>";
        
        echo '<h2>EvaluationTableGateway Tests';
        $evalGate = new EvaluationTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $evals = $evalGate->findAll();
        foreach ($evals as $eval) {
            print_r($eval);
            echo '<br/>';
        }

        echo '<h2>FinalGradeTableGateway Tests';
        $finalGradeGate = new FinalGradeTableGateway($dbAdapter);
        echo '<h3>findAll()</h3>';
        $finalGrades = $finalGradeGate->findAll();
        foreach ($finalGrades as $finalGrade) {
            print_r($finalGrade);
            echo '<br/>';
        }
    ?>
</body>
</html>
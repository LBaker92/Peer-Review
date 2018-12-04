<?php
session_start();
include "../includes/config.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $evalGate = new EvaluationTableGateway($dbAdapter);
    $eval = array(
        "CourseID" => $_POST["course_id"],
        "CourseTitle" => $_POST["title"],
        "Section" => $_POST["section"],
        "Semester" => $_POST["semester"],
        "Year" => $_POST["year"],
        "InstructorID" => $_SESSION["user"]["InstructorID"],
        "PublishEval" => false
    );
    
    $eval = new Evaluation($eval, false);
    $evalGate->insert($eval);
    $eval = $evalGate->findByEval($eval);

    $rosterLoc = saveCSV($_FILES["roster"]);
    if ($rosterLoc) {
        $students = parseCSV($rosterLoc, $eval);
        $studentGate = new StudentTableGateway($dbAdapter);
        // Loop through the students array, convert them to Student objects and insert into the DB
        $studentsFromDb = $studentGate->findAll();
        foreach($students as $student) {
            $student = new Student($student, false);
            $alreadyUpdated = false;
            foreach($studentsFromDb as $s) {
                if ($student->Email == $s->Email) {
                    $s->EvaluationID = $student->EvaluationID;
                    $s->GroupID = null;
                    $studentGate->updateEvalAndGroupID($s);
                    $alreadyUpdated = true;
                    break;
                }
            }
            if (!$alreadyUpdated) {
                $studentGate->insert($student);
                // PUT EMAIL FUNCTION HERE
            }
        }
    }
    header("Location: ../admin/manager.php");
}

function saveCSV($filename) 
{
    $dir = "../uploads/" . $filename["name"] . " " . date("m-d-Y");
    $fileExt = strtolower(pathinfo($filename["name"], PATHINFO_EXTENSION));
    if ($fileExt != "csv") {
        return;
    }
    move_uploaded_file($filename["tmp_name"], $dir);
    return $dir;
}

/*
    CSV format should be [0]LastName, [1]FirstName, [2]Username
*/

function parseCSV($fileLoc, $eval) 
{
    $students = array();
    $file = fopen($fileLoc, "r") or die("ERROR OPENING FILE");
    // The first line is the headers
    $headers = fgetcsv($file);
    while (!feof($file)) {
        $row = fgetcsv($file);
        if (!empty($row)) {
            $student = array(
                "FirstName" => $row[1],
                "LastName" => $row[0],
                "Email" => convertToEmail($row[2]),
                "Password" => generatePassword($row),
                "EvaluationID" => $eval->EvaluationID,
                "CompletedEval" => false
            );
            array_push($students, $student);
        }
    }
    return $students;
}

function convertToEmail($username)
{
    return (string)($username . "@kent.edu");
}

function generatePassword($row)
{
    return (string)($row[1] . $row[0] . rand(100, 999));
}

?>
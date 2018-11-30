<?php
session_start();
include "../includes/config.inc.php";
foreach(glob("PHPMailer/src/") as $fileName) {
    include $fileName;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $evalGate = new EvaluationTableGateway($dbAdapter);
    $eval = array(
        "CourseID" => $_POST["course_id"],
        "CourseTitle" => $_POST["title"],
        "Section" => $_POST["section"],
        "Semester" => $_POST["semester"],
        "Year" => $_POST["year"],
        "InstructorID" => $_SESSION["user"]["InstructorID"]
    );
    
    $eval = new Evaluation($eval, false);
    $evalGate->insert($eval);
    $eval = $evalGate->findByEval($eval);

    $rosterLoc = saveCSV($_FILES["roster"]);
    if ($rosterLoc) {
        $students = parseCSV($rosterLoc, $eval);
        $studentGate = new StudentTableGateway($dbAdapter);
        // Loop through the students array, convert them to Student objects and insert into the DB
        foreach($students as $student) {
            $student = new Student($student, false);
            $studentGate->insert($student);
        }
    }
    header("Location: ../admin/index.php");
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
                "EvaluationID" => $eval->EvaluationID
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
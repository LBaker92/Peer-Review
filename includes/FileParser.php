<?php

include_once 'helper-functions.php';
include_once '../lib/gateways/StudentTableGateway.class.php';

if (isset($_POST["submit"])) {

    $i = strlen($_FILES["roster"]["name"]) - 3; //
    $extension = strtolower(substr($_FILES["roster"]["name"], $i));

    if ($extension == "csv") {

        $filepath = saveToServer($_FILES);
        $students = parseCsv($filepath);

        $usergate = new StudentTableGateway();
        foreach($students as $student) {
            $usergate->insert($student);
        }
    }

}

?>
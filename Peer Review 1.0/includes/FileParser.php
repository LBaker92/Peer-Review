<?php

include_once 'helper-functions.php';
include_once '../lib/gateways/StudentTableGateway.class.php';

if (isset($_POST["submit"])) {

    $i = strlen($_FILES["roster"]["name"]) - 3; //
    $extension = strtolower(substr($_FILES["roster"]["name"], $i));

    notifyStudent("zenrion@gmail.com", "test123");

    if ($extension == "csv") {

        $filepath = saveToServer($_FILES);
        $students = parseCsv($filepath);

        $usergate = new StudentTableGateway();
        foreach($students as $student) {
            $usergate->insert($student);
            // SEND EMAIL TO USER WITH THEIR PASSWORD
        }
    }
    else if ($extension == "") { // If we can't find a file extension, assume nothing was entered.
        header("Location: ../admin/index.php?file=empty");
    }
    else {
        header("Location: ../admin/index.php?file=invalid");
    }

}

?>
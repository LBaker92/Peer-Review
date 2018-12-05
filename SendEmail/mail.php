
<?php
require_once 'PHPMailer/PHPMailerAutoload.php';
include '../includes/helpers.inc.php';
session_start();
$evalID = $_SESSION["evalID"];
$evalgate = new EvaluationTableGateway($dbAdapter);
$course = $evalgate->findByEvalID($evalID);
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sending Email to All Students</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <br />
    <div class="inner contact">
        <!-- Form Area -->
        <div class="contact-form">
            <h1 align="center">Sending Email to All Students</h1>
            <h3 align="center"> Course Title :<?php echo " ".$course->CourseID." ".$course->CourseTitle ?> </h3>
			<h3 align="center"> Semester :<?php echo " ".$course->Semester ?> </h3>
			<h3 align="center"> Year : <?php echo " ".$course->Year ?></h3>
            <hr>
            <br>
			<a href="../admin/manager.php"> Go back to Manager page</a>
			<br><br>
        </div>
        <!-- End Contact Form Area -->
    </div>
</body>

</html>



<?php

if(isset($_POST['send']))
{
// Fetching data that is entered by the user
	$email = $_POST['email'];
	$password = $_POST['password'];

	$message = $_POST['message'];
	$subject = $_POST['subject'];
	$courseTitle = " Introduction to Database Systems Design";
	
	#echo "evaluation ID=".$_SESSION["evalID"]."<br>";

	$studentGate = new StudentTableGateway($dbAdapter);
        // Loop through the students list and send message one by one
    //$studentsFromDb = $studentGate->findAll();
	$studentsFromDb = $studentGate->findByEvalID($_SESSION["evalID"]);
		
	foreach($studentsFromDb as $student) {
        $to_email = $student->Email;
		$message = $message.$student->Password;
		#echo $student->Email."<br>";
		send_email($email, $password, $to_email, $subject, $message, $courseTitle );
    }

// Configuring SMTP server settings

}
else{
		echo '<p>Please enter valid data</p>';
	}

function send_email($email, $password, $to_email, $subject, $message, $courseTitle ){
	
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = $email;
	$mail->Password = $password;
	$mail->FromName = $courseTitle;

	// Email Sending Details
	$mail->addAddress($to_email);
	$mail->Subject = $subject;
	$mail->msgHTML($message);

	// Success or Failure
	if (!$mail->send()) {
		$error = "Mailer Error: " . $mail->ErrorInfo;
		echo '<p>'.$error.'</p>';
	}
	else {
		echo 'Message sent to : '.$to_email."<br>";
	}
}
	
?>
<?php
include '../includes/helpers.inc.php';
session_start();

$evalID = $_POST["evalID"]; // get this ID from the course selection page
$evalgate = new EvaluationTableGateway($dbAdapter);
$course = $evalgate->findByEvalID($evalID);
$_SESSION["evalID"] =  $evalID;
//echo $course->CourseID;
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
            <!-- Form -->
            <form action="mail.php" method="post">
                <!-- Left Inputs -->
                <div class="col-xs-6">

                    <h3>Enter Your Gmail ID and Password</h3>
                    <p>Before using your Gmail ID and Password check whether your <a href="https://support.google.com/accounts/answer/6010255?hl=en" target="_blank">Gmail less secure apps</a> is <b>on</b> or <b>not</b>.</p>
                    <input type="text" name="email" required class="form" placeholder="Enter your email ID" />

                    <input type="password" name="password" required class="form" placeholder="Password" />

                </div>
                <!-- End Left Inputs -->

                <!-- Right Inputs -->
                <div class="col-xs-6">

                    <h3>To Address</h3>

                    <input type="text" name="subject" required class="form" placeholder="Subject" />

                    <textarea name="message" class="form textarea" placeholder="Message"></textarea>
                </div>
                <!-- End Right Inputs -->

                <!--  Submit -->
                    <button type="submit" id="submit" name="send" class="form-btn semibold">Send Message</button>
                <!-- End Submit -->
                <!-- Clear -->
                <div class="clear"></div>
            </form>

        </div>
        <!-- End Contact Form Area -->
    </div>
</body>

</html>
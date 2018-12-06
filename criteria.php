<?php
include "includes/helpers.inc.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php insertLinks(); ?>
</head>
<body>
    <?php insertNavbar(); ?>
    <div class="container">
        <div class="row"></div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="text-center">Peer Evaluation for Group Project</h3>
                <div class="row mt-5">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <p>Each Group Member is required to submit a Peer Evaluation.
                        Please evaluate<br>(a) your performance <br>(b) the performance of each member in your Group.<br>
                        The information you provide is confidential and only your professor will see and use it.
                        </p>
                        <p>Please use the following criteria to rate yourself and each member in your Group:</p>
                        <ol>
                            <li>
                                <strong>Effort / Active Participation:</strong> Following through on the project and being accountable to group members.
                            </li>
                            <li>
                                <strong>Contribution:</strong> Improving quality of work, being creative, bringing unique skills and abilities that aid in the quality of the final product, and providing leadership.
                            </li>
                            <li>
                                <strong>Attendance:</strong> Attending team meetings and or group activities.
                            </li>
                            <li>
                                <strong>Supported Group Process:</strong> Eliciting and valuing input of others, mediating arguments and relieving tension, lending a positive attitude, and other maintenance roles that enhance group social climate.
                            </li>
                            <li>
                                <strong>Communication:</strong> Checking in with the Group before missing a meeting, clarifying expectations, keeping communication channels open, facilitating others’ participation, and “speaking” and “listening” effectively.
                            </li>
                        </ol>
                        <p>Provide a rating for yourself and your Group Members using the scale from 1 to 10 below:</p>
                        <ul>
                            <li>1-2 Poor</li>
                            <li>3-4 Mediocre</li>
                            <li>5-6 Average</li>
                            <li>7-8 Good</li>
                            <li>9-10 Exceptional</li>
                        </ul>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
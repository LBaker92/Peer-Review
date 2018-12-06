<?php
include '../includes/config.inc.php';
session_start();

unset($_SESSION["errors"]["title"]);
unset($_SESSION["errors"]["description"]);
unset($_SESSION["errors"]["leader"]);
unset($_SESSION["errors"]["memberIDs"]);
unset($_SESSION["errors"]["included"]);
?>

<?php
    // CHECK AMT OF MEMBERS NOT OVER 5
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["title"])) {
            $_SESSION["errors"]["title"] = "You need to enter a project title.";
        }

        if (empty($_POST["description"])) {
            $_SESSION["errors"]["description"] = "You need to enter a project description.";
        }

        if (empty($_POST["leader"])) {
            $_SESSION["errors"]["leader"] = "You need to enter your group leader's email.";
        }

        if (empty($_POST["memberIDs"])) {
            $_SESSION["errors"]["memberIDs"] = "You need to pick your group members.";
        }

        if (empty($_SESSION["errors"])) {
            $groupGate = new GroupTableGateway($dbAdapter);
            $groups = $groupGate->findAll();

            foreach($groups as $group) {
                if ($group->ProjectName == $_POST["title"]) {
                    $_SESSION["errors"]["title"] = "A group with this name already exists.";
                }
            }

            if (count($_POST["memberIDs"]) > $MAX_GROUP_SIZE) {
                $_SESSION["errors"]["memberIDs"] = "You selected more than " . $MAX_GROUP_SIZE . " group members.";
            }

            $leaderSelected = false;
            foreach($_POST["memberIDs"] as $memberID) {
                if ($_SESSION["user"]["StudentID"] == $memberID) {
                    $leaderSelected = true;
                    break;
                }
            }
            if (!$leaderSelected) {
                $_SESSION["errors"]["included"] = "The leader of the group must be included.";
            }

            if ($_SESSION["user"]["Email"] != $_POST["leader"]) {
                $_SESSION["errors"]["leader"] = "You must be the group's leader to create the group.";
            }

            // Validation succeeded
            if (empty($_SESSION["errors"])) {
                $groupArray = array(
                    "ProjectName" => $_POST["title"],
                    "ProjectDescription" => $_POST["description"],
                    "LeaderEmail" => $_POST["leader"]
                );
                $group = new Group($groupArray, false);
                $groupGate->insert($group);
                $group = $groupGate->findBy("ProjectName = ?", Array($_POST["title"]))[0];

                $studentGate = new StudentTableGateway($dbAdapter);
                foreach($_POST["memberIDs"] as $memberID) {
                    $student= $studentGate->findByID($memberID); 
                    $studentGate->setGroupID($student->StudentID, $group->GroupID);
                }
                $_SESSION["user"]["GroupID"] = $group->GroupID;
                header("Location: ../student/evaluation.php");
            }
            // Validation failed
            else {
                header("Location: ../student/index.php");
            }
        }
        // A field was blank
        else {
            header("Location: ../student/index.php");
        }
    }
    // They didn't submit a form
    else {
        header("Location: ../student/index.php");
    }
?>
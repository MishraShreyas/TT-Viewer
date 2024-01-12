<?php
require_once("functions.php");
if (!IsLoggedIn()) header("location: login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title> TimeTable </title>
    <link rel="stylesheet" type="text/css" href="css/timetable.css">
</head>
<body>
    <?php require_once("header.php");?>

    <div class='' style="margin: auto; max-width: 600px; text-align: center;">
        <div>
            <?php
            $day = date("l");
            $currtime = date("H:i");
            echo "<div><br><h1 style='color:cyan'>Today's Schedule</h1></div><br>";
            $schedule = mysqli_fetch_all(GetSchedule($conn, $day), MYSQLI_ASSOC);
            usort($schedule, function($a, $b) {
                return strtotime($a["slot"]) - strtotime($b["slot"]);
            });
            foreach($schedule as $slot) {
                $subject = mysqli_fetch_assoc(GetSubjectByCode($conn, $slot["subjectcode"]));

                $time = $slot["slot"];
                $code = $subject["code"];
                $title = $subject["title"];
                $color = $subject["color"];
                $venue = $slot["venue"];
                echo "<div><h2 style='color: $color;'>$time - $code - $title - $venue</h2></div><br>";
            }
            ?>
        </div>
        <div>
            <div><br><h1 style='color:cyan'>Upcoming classes</h1></div><br>
            <?php
            foreach($schedule as $slot) {
                if (strtotime($currtime) > strtotime($slot["slot"])) continue;

                $subject = mysqli_fetch_assoc(GetSubjectByCode($conn, $slot["subjectcode"]));

                $time = $slot["slot"];
                $code = $subject["code"];
                $title = $subject["title"];
                $color = $subject["color"];
                $venue = $slot["venue"];
                echo "<div><h2 style='color: $color;'>$time - $code - $title - $venue</h2></div><br>";
            }
            ?>
        </div>
    </div>
    <?php require_once("footer.php");?>
</body>
</html>
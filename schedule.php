<?php
require_once("functions.php");
if (!IsLoggedIn()) header("location: login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title> Schedule - TTView </title>
    <link rel="stylesheet" type="text/css" href="css/accents.css">
</head>
<body>
    <?php require_once("header.php");?>
    <br>
    <div class = "centered">
        <div class = "centered">
            <h1 style="color: cyan">Today's Schedule</h1><br>
            <?php
            $day = strtolower(date("l"));
            $day = "friday";
            $currtime = date("H:i");
            $schedule = mysqli_fetch_all(GetSchedule($conn, $day), MYSQLI_ASSOC);
            usort($schedule, function($a, $b) {
                return strtotime($a["slot"]) - strtotime($b["slot"]);
            });
            foreach($schedule as $slot) {
                $subject = mysqli_fetch_assoc(GetSubjectByCode($conn, $slot["subjectcode"]));

                $color = $subject["color"];
                $code = "<h4>[ " . $subject["code"] . " ]</h4>" ;
                $title = "<h3>" . $subject["title"] . "</h3>";
                $time = "<h4>Time: " . date("g:i A", strtotime($slot["slot"])) . "</h4>";
                $venue = "<h4>Room: " . $slot["venue"] . "</h4>";
                $div = "<div><a href='slot_add_edit.php?day=$day&slot={$slot['slot']}&action=edit'>";
                $span = "<span class = 'accent-$color-gradient' style = 'display: table'>";
                $end = "</span></a></div><br><br>";
                echo $div . $span . $code . $title . $venue . $time . $end;
            }
            ?>
        </div>
        <div class = "centered">
            <div><br><h1 style='color:cyan'>Upcoming classes</h1></div><br>
            <?php
            foreach($schedule as $slot) {
                if (strtotime($currtime) > strtotime($slot["slot"])) continue;

                $subject = mysqli_fetch_assoc(GetSubjectByCode($conn, $slot["subjectcode"]));
                $color = $subject["color"];
                $code = "<h4>[ " . $subject["code"] . " ]</h4>" ;
                $title = "<h3>" . $subject["title"] . "</h3>";
                $time = "<h4>Time: " . date("g:i A", strtotime($slot["slot"])) . "</h4>";
                $venue = "<h4>Room: " . $slot["venue"] . "</h4>";
                $div = "<div><a href='slot_add_edit.php?day=$day&slot={$slot['slot']}&action=edit'>";
                $span = "<span class = 'accent-$color-gradient' style = 'display: table'>";
                $end = "</span></a></div><br><br>";
                echo $div . $span . $code . $title . $venue . $time . $end;
            }
            ?>
        </div>
    </div>
    <?php require_once("footer.php");?>
</body>
</html>
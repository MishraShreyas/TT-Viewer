<!DOCTYPE html>
<html>
<head>
    <title> TimeTable - TTView </title>
    <link rel="stylesheet" type="text/css" href="css/timetable.css">
</head>
<body>
    <?php require_once("header.php");?>
    <div class="timetable" id = "section-to-print">
        <div class="week-names">
            <div>monday</div>
            <div>tuesday</div>
            <div>wednesday</div>
            <div>thursday</div>
            <div>friday</div>
            <div class="weekend">saturday</div>
            <div class="weekend">sunday</div>
        </div>
        <div class="time-interval">
            <div>8:30 - 9:25</div>
            <div>9:30 - 10:25</div>
            <div>10:40 - 11:35</div>
            <div>11:40 - 12:35</div>
            <div>12:40 - 13:30</div>
            <div>13:30 - 14:25</div>
            <div>14:30 - 15:25</div>
            <div>15:40 - 16:35</div>
            <div>16:40 - 17:35</div>
        </div>
        <div class="content">
            <?php
            $lunch_row = "12:40";
            $days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
            $slots = array("8:30","9:30", "10:40", "11:40", "12:40", "13:30", "14:30", "15:40", "16:40");

            foreach($slots as $slot) {
                if ($slot == $lunch_row) {
                    foreach ($days as $day)
                        echo "<div class='lunch-break'></div>";
                } else {
                    foreach ($days as $day) {
                        $arr = GetTimeTable($conn, $day, $slot);
                        if (is_null($arr)) {
                            $cell = "<div><a style='color:white;' href='slot_add_edit.php?day=$day&slot=$slot&action=add'>x</a></div>";
                        } else {
                            $clr = $arr["color"];
                            $title = $arr["title"];
                            $code = $arr["code"];
                            $venue = $arr["venue"];
                            $br = "<br>";
                            $href = "<a style='width: 100%; height: 100%;' href='slot_add_edit.php?day=$day&slot=$slot&action=edit'>";
                            $padding = "<div style='padding: 10px;'>";
                            $end = "</div></div></a>";
                            $cell = $href . $clr . $padding . $title . $br . $code . $br . $venue . $end;
                        }
                        if ($day == "saturday" or $day == "sunday")
                            echo "<div class = 'weekend'>$cell</div>";
                        else echo "<div>$cell</div>";
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php //require_once("footer.php");?>
</body>
</html>
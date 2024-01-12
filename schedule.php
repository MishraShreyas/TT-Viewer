<!DOCTYPE html>
<html>
<head>
    <title> TimeTable </title>
    <link rel="stylesheet" type="text/css" href="css/timetable.css">
</head>
<body>
    <?php require_once("header.php");?>

    <div style="margin: auto; max-width: 600px; text-align: center;">
        <?php
        $day = date("l");
        $slot = date("H:i");
        echo "<div><br><h1 style='color:cyan'>Schedule - $day</h1></div>";
        ?>
    </div>
    <?php require_once("footer.php");?>
</body>
</html>
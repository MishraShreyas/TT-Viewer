<!DOCTYPE html>
<html>
<head>
    <title> TimeTable </title>
    <link rel="stylesheet" type="text/css" href="css/timetable.css">
</head>
<body>
    <?php require_once("header.php");?>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "GET") print_r($_GET);
    ?>
    <?php require_once("footer.php");?>
</body>
</html>
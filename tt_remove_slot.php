<?php
require_once("functions.php");
if (($_SERVER["REQUEST_METHOD"] == "POST")) {
    RemoveSlot($conn, addslashes($_POST["day"]), addslashes($_POST["slot"]));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> TimeTable </title>
    <link rel="stylesheet" type="text/css" href="css/timetable.css">
</head>
<body>
    <?php require_once("header.php");?>
    <?php if($_SERVER['REQUEST_METHOD'] != "GET") header("location: index.php");
    $day = $_GET["day"];
    $slot = $_GET["slot"];
    $arr = GetTimeTable($conn, $day, $slot);
    ?>

    <div style="margin: auto; max-width: 600px; text-align: center;">
        <div><br><h1 style='color:red'>Are you sure you want to remove -</h1></div> <br>
        <div><h2><?php echo $arr["code"]?></h2></div> <br>
        <div><h2><?php echo $arr["title"]?></h2></div> <br>
        <div><h2>Day: <?php echo ucfirst($_GET["day"])?></h2></div> <br>
        <div><h2>Time: <?php echo $_GET["slot"]?></h2></div> <br>
        <div><h2>Venue: <?php echo $arr["venue"]?></h2></div>
        <div>
            <form method="post" style="margin: auto; padding: 10px"><h2>
                <?php
                echo "<input type='hidden' name = 'day' value = $day>";
                echo "<input type='hidden' name = 'slot' value = $slot>";
                ?>
                <button>Delete</button>
            </h2></form>
        </div>
    </div>

    <?php require_once("footer.php");?>
</body>
</html>
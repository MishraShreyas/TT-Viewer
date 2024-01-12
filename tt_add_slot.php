<?php
require_once("functions.php");
if (!IsLoggedIn()) header("location: login.php");
if (($_SERVER["REQUEST_METHOD"] == "POST")) {
    AddSlot($conn, addslashes($_POST["day"]), addslashes($_POST["slot"]), addslashes($_POST["subject"]), addslashes(strtoupper($_POST["venue"])));
    print_r($_GET);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> TimeTable </title>
</head>
<body>
    <?php require_once("header.php");?>
    <?php if($_SERVER['REQUEST_METHOD'] != "GET") header("location: index.php"); ?>

    <div style="margin: auto; max-width: 600px; text-align: center;">
        <div><br><h1>Add Slot</h1></div> <br>
        <div><h2>Day: <?php echo ucfirst($_GET["day"])?></h2></div> <br>
        <div><h2>Time: <?php echo $_GET["slot"]?></h2></div>
        <div>
            <form method="post" style="margin: auto; padding: 10px"><h2>
                <?php
                $day = $_GET["day"];
                $slot = $_GET["slot"];
                echo "<input type='hidden' name = 'day' value = $day>";
                echo "<input type='hidden' name = 'slot' value = $slot>";
                ?>
                <label>Subject:  </label>
                <select name = "subject" id = "subject">
                    <?php
                    $subjects = GetSubjects($conn);
                    foreach($subjects as $subject) {
                        $code = $subject["code"];
                        $title = $subject["title"];
                        echo "<option value = $code>$code: $title</option>";
                    }
                    ?>
                </select>
                <input style='width: 30%;' type="text" name = "venue" placeholder = "venue" required><br>
                <button>Add</button>
            </h2></form>
        </div>
    </div>

    <?php require_once("footer.php");?>
</body>
</html>
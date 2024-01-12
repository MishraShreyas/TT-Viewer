<?php
require_once("functions.php");
if (!IsLoggedIn()) header("location: login.php");
if (($_SERVER["REQUEST_METHOD"] == "POST")) {
    if ($_POST["action"] == "edit")
        EditSlot($conn, addslashes($_POST["day"]), addslashes($_POST["slot"]), addslashes($_POST["subject"]), addslashes(strtoupper($_POST["venue"])));
    else if ($_POST["action"] == "delete")
        RemoveSlot($conn, addslashes($_POST["day"]), addslashes($_POST["slot"]));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> TimeTable </title>
</head>
<body>
    <?php require_once("header.php");?>
    <?php if($_SERVER['REQUEST_METHOD'] != "GET") header("location: index.php");
    //getting vars
    $day = $_GET["day"];
    $slot = $_GET["slot"];
    $arr = GetTimeTable($conn, $day, $slot);
    ?>

    <div style="margin: auto; max-width: 600px; text-align: center;">
        <div><br><h1 style='color:cyan'>Editing slot -</h1></div> <br>
        <div><h2>Day: <?php echo ucfirst($_GET["day"])?></h2></div> <br>
        <div><h2>Time: <?php echo $_GET["slot"]?></h2></div> <br>
        <div>
            <form method='post' style="margin: auto; padding: 10px">
                <h2>
                    <label>Subject:  </label>
                    <select name = "subject" id = "subject">
                        <?php
                        $subjects = GetSubjects($conn);
                        foreach($subjects as $subject) {
                            $code = $subject["code"];
                            $title = $subject["title"];
                            $option = "<option value = $code>$code: $title</option>";
                            if ($code == $arr["code"]) $option = "<option value = $code selected>$code: $title</option>";
                            echo $option;
                        }
                        ?>
                    </select>
                    <?php
                    $venue = $arr["venue"];
                    echo "<input style='width: 30%;' type='text' name = 'venue' value = '$venue' placeholder = 'venue' required/>"
                    ?>
                    <br>
                    <?php
                    echo "<input type='hidden' name = 'day' value = $day>";
                    echo "<input type='hidden' name = 'slot' value = $slot>";
                    echo "<input type='hidden' name = 'action' value = 'edit'>";
                    ?>
                    <button>Edit</button>
                </h2>
            </form>
        </div>
        <div>
            <form method="post" style="margin: auto; padding: 10px"><h2>
                <?php
                echo "<input type='hidden' name = 'day' value = $day>";
                echo "<input type='hidden' name = 'slot' value = $slot>";
                echo "<input type='hidden' name = 'action' value = 'delete'>";
                ?>
                <button>Delete</button>
            </h2></form>
        </div>
    </div>

    <?php require_once("footer.php");?>
</body>
</html>
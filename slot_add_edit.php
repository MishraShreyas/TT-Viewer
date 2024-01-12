<?php
require_once("functions.php");
if (!IsLoggedIn()) header("location: login.php");
if (($_SERVER["REQUEST_METHOD"] == "POST")) {
    if ($_POST['action'] == "add") {
        AddSlot($conn, addslashes($_POST["day"]), addslashes($_POST["slot"]), addslashes($_POST["subject"]), addslashes(strtoupper($_POST["venue"])));
    }
    else if ($_POST['action'] == "edit") {
        EditSlot($conn, addslashes($_POST["day"]), addslashes($_POST["slot"]), addslashes($_POST["subject"]), addslashes(strtoupper($_POST["venue"])));
    }
    else if ($_POST['action'] == "delete") {
        RemoveSlot($conn, addslashes($_POST["day"]), addslashes($_POST["slot"]));
    }
} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action == "edit") {
            $day = $_GET["day"];
            $slot = $_GET["slot"];
            $arr = GetTimeTable($conn, $day, $slot);
        }
        $action = ucfirst($action);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> TimeTable </title>
</head>
<body>
    <?php require_once("header.php");?>
    <br>
    <div style="margin: auto; max-width: 600px; text-align: center;">
        <?php echo "<h1 style='color: cyan;'>$action Slot</h1>";?><br>
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
                <select name = "subject" style = "width: 300px" id = "subject" required>
                    <option value = "" selected>Select Subject</option>
                    <?php
                    $subjects = GetSubjects($conn);
                    foreach($subjects as $subject) {
                        $code = $subject["code"];
                        $title = $subject["title"];
                        $selected = "";
                        if ($action == "Edit" && $code == $arr["code"]) $selected = "selected";
                        echo "<option value = '$code' $selected>$code: $title</option>";
                    }
                    echo "</select><br>";
                    $venue_val = "";
                    if ($action == "Edit") $venue_val = $arr["venue"];
                    echo "<input style='max-width: 100px;' type='text' name='venue' placeholder='Venue' value = '$venue_val' required><br>";
                    echo "<button>$action</button>";
                    $action = strtolower($action);
                    echo "<input type='hidden' name='action' value='$action'>";
                    ?>
            </h2></form>
            <?php
                if ($action == "edit") {
                    echo "<form method='post'>";
                    echo "<input type='hidden' name = 'day' value = '$day'>";
                    echo "<input type='hidden' name = 'slot' value = '$slot'>";
                    echo "<input type='hidden' name = 'action' value = 'delete'>";
                    echo "<button class = 'delete'>Delete</button></form>";
                    echo "<br>";
                }
            ?>
        </div>
    </div>

    <?php require_once("footer.php");?>
</body>
</html>
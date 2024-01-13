<?php
require_once("functions.php");
if (!IsLoggedIn()) header("location: login.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST["action"] == "add") {
        AddSubject($conn, addslashes($_POST["code"]), addslashes($_POST["title"]), addslashes($_POST["color"]));
    } else if ($_POST["action"] == "edit") {
        EditSubject($conn, addslashes($_POST["code"]), addslashes($_POST["title"]), addslashes($_POST["color"]));
    } else if ($_POST["action"] == "delete") {
        RemoveSubject($conn, addslashes($_POST["code"]));
    }
} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action == "edit") {
            $code = $_GET["code"];
            $result = GetSubjectByCode($conn, $code);
            $subject = mysqli_fetch_assoc($result);
        }

        $action = ucfirst($action);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subject - TTView</title>
</head>
<body>
    <?php require_once("header.php");?> <br>
    <div style="margin: auto; text-align: center;">
        <?php echo "<h1 style='color: cyan;'>$action Subject</h1>";?>
        <form method="post">
        <div class = "container">
            <?php
            $placeholder_code = "";
            $placeholder_title = "";
            if ($action == "Edit") {
                $placeholder_code = $subject['code'];
                $placeholder_title = $subject['title'];
            }
            echo "<input style='max-width: 200px;' type='text' name='code' placeholder='Course Code' value = '$placeholder_code' required><br>";
            echo "<input style='max-width: 200px;' type='text' name='title' placeholder='Course Title' value = '$placeholder_title' required><br>";

            $colors =array("", "pink", "orange", "green", "cyan", "blue", "purple");
            echo '<select name="color" style="width: 150px;">';
            foreach ($colors as $color) {
                $selected = "";
                if ($action == "Edit" && $color == $subject['color']) $selected = "selected";
                $txt = ucfirst($color);
                if ($color == "") $txt = "Select Color";
                echo "<option value='$color' $selected>$txt</option>";
            }
            echo "</select><br>";
            echo "<button>$action</button>";
            $action = strtolower($action);
            echo "<input type='hidden' name='action' value='$action'>";
            ?>
        </div>
        </form> 
        <?php
            if ($action == "edit") {
                echo "<form method='post'>";
                echo "<input type='hidden' name = 'code' value = '$code'>";
                echo "<input type='hidden' name = 'action' value = 'delete'>";
                echo "<button class = 'delete'>Delete</button></form>";
                echo "<br>";
            }
        ?>
    </div>
    <?php require_once("footer.php");?>
</body>
</html>

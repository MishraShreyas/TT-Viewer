<?php
require_once("functions.php");
if (!IsLoggedIn()) header("location: login.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST["title"]))
        AddSubject($conn, addslashes($_POST["code"]), addslashes($_POST["title"]), addslashes($_POST["color"]));
}
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    if (isset($_GET["code"])) {
        RemoveSubject($conn, addslashes($_GET["code"]));
    }
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
    
    <div style="margin: auto; max-width: 600px;">

        <div>
            <h1 style="text-align: center; color: white">Subjects</h1>
                <br>
            <form method = "post" style="margin: auto; padding: 10px; display: inline-block'">
            <?php 
                $subjects = GetSubjects($conn);
                while ($row = mysqli_fetch_assoc($subjects)) {
                    $title = $row["title"];
                    $code = $row["code"];
                    echo "<div style='text-align: center; color: white'><h4>$code : $title &nbsp;&nbsp; <a style='color: cyan;' href='subjects.php?code=$code'>Delete</a></h4></div>";
                }
            ?>
            </form>
        </div>

        <br><br>

        <div style="margin: auto; max-width: 600px; text-align: center;">
            <h2 style="color: white">Add New</h2>
            <form method="post" style="margin: auto; padding: 10px">
                <input type="text" name="code" placeholder="Course Code" required><br>
                <input type="text" name="title" placeholder="Course Title" required><br>
                <select name="color">
                    <option value="">Select Color</option>
                    <option value="pink">Pink</option>
                    <option value="orange">Orange</option>
                    <option value="green">Green</option>
                    <option value="cyan">Cyan</option>
                    <option value="blue">Blue</option>
                    <option value="purple">Purple</option>
                </select><br>
                <button>Add Course</button>
            </form> 
        </div>

    </div>

    <?php require_once("footer.php");?>
</body>
</html>
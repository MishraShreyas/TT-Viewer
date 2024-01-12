<?php
require_once("functions.php");
if (!IsLoggedIn()) header("location: login.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title> Subjects - TTView </title>
    <link rel="stylesheet" type="text/css" href="css/accents.css">
</head>
<body>
    <?php require_once("header.php");?>
    <br>
    <div class = 'center-text'>
        <h1 style="color: cyan">Subjects</h1><br>
        <?php 
            $subjects = GetSubjects($conn);
            while ($row = mysqli_fetch_assoc($subjects)) {
                $title = $row["title"];
                $code = $row["code"];
                $color = $row["color"];

                $div = "<div><h3>";
                $span ="<span class = 'accent-$color-gradient'>";
                $subject = "$code : $title";
                $href = "<a href='subject_add_edit.php?code=$code&action=edit'>";
                $end = "</h3></span></a></div><br><br>";
                echo $div . $href . $span . $subject . $end;
            }
            echo "<div><h3><a href='subject_add_edit.php?action=add'><span class = 'accent-green-gradient' style: 'font-weight: 600;'>+</span></a></h3></div><br><br>";
        ?>
    </div>

    <?php require_once("footer.php");?>
</body>
</html>
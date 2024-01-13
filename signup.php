<?php
require_once("functions.php");
if (IsLoggedIn()) header("location: index.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    SignUp($conn, addslashes($_POST["username"]), addslashes($_POST["email"]), addslashes($_POST["password"]));
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Signup - TTView</title>
    </head>

    <body>
        <?php require_once("header.php");?>
        <br>
        <div style="margin: auto; max-width: 600px; text-align: center;">
            <h2 style="color: cyan">SIGN UP</h2>
            <form method="post" style="margin: auto; padding: 10px">
                <input style="width: 200px" type="text" name="email" placeholder="Email" required><br>
                <input style="width: 200px" type="text" name="username" placeholder="Username" required><br>
                <input style="width: 200px" type="password" name="password" placeholder="Password" required><br>

                <button>Sign Up</button>
            </form> 
        </div>

        <?php require_once("footer.php");?>
    </body>
</html>
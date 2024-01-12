<?php
require_once("functions.php");
if (IsLoggedIn()) header("location: index.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (LogIn($conn, addslashes($_POST["email"]), addslashes($_POST["password"])))
    {
        header("location: index.php");
        die;
    } else {
        $error = "Incorrect email or password";
    }

    //print_r(LogIn($conn, addslashes($_POST["email"]), addslashes($_POST["password"])));
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login - TTView</title>
    </head>

    <body>
        <?php require_once("header.php");?>
        <div style="margin: auto; max-width: 600px; text-align: center;">
            <h2 style="color: white">LOGIN</h2>
            <form method="post" style="margin: auto; padding: 10px">
                <input type="text" name="email" placeholder="Email"><br>
                <input type="password" name="password" placeholder="Password"><br>

                <button>Login</button>
            </form> 
        </div>
        <?php if (!empty($error)) {
            echo "<div style='color:red'>$error</div>";
        }            
        ?>
         

        <?php require_once("footer.php");?>
    </body>
</html>
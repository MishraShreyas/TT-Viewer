<!DOCTYPE html>
<html>
    <head>
        <title>Login - TTView</title>
    </head>

    <body>
        <?php require_once("header.php");?>
        <div style="margin: auto; max-width: 600px;">
            <h2 style="text-align: center; color: white">LOGIN</h2>
            <form method="post" style="margin: auto; padding: 10px">
                <input type="text" name="email" placeholder="Email"><br>
                <input type="password" name="password" placeholder="Password"><br>

                <button>Login</button>
            </form> 
        </div>

        <?php require_once("footer.php");?>
    </body>
</html>
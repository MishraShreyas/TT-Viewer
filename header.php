<?php require_once("functions.php"); ?>

<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<header>
    <div><a href = "index.php">Home</a></div>
    <?php if(!IsLoggedIn()):?>
        <div><a href = "login.php">Login</a></div>
        <div><a href = "signup.php">Sign Up</a></div>
    <?php else:?>
        <div><a href = "schedule.php">Schedule</a></div>
        <div><a href = "subjects.php">Subjects</a></div>
        <div><a href = "logout.php">Log Out</a></div>
    <?php endif;?>
</header>
<?php

require("connection.php");

function SignUp($conn, $username, $email, $password) {
    $date = date("d/m/Y");

    $query = "insert into users (username, email, password, date) values ('$username', '$email', '$password', '$date')";

    $result = mysqli_query($conn, $query);
    
    header("location: login.php");
    die;
}


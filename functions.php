<?php

require_once("connection.php");

date_default_timezone_set('Asia/Kolkata');

function SignUp($conn, $username, $email, $password) {
    $date = date("d/m/Y");

    $query = "insert into users (username, email, password, date) values ('$username', '$email', '$password', '$date')";

    $result = mysqli_query($conn, $query);
    
    header("location: login.php");
    die;
}

function LogIn( $conn, $email, $password ) {
    $query = "select * from users where email = '$email' && password = '$password' limit 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['info'] = $row;

        return true;
    } else return false;
}

function IsLoggedIn() {
    return !empty($_SESSION['info']);
}

function GetTimeTable($conn, $day, $slot) {
    if (!isset($_SESSION['info'])) return null;

    $id = $_SESSION['info']['id'];
    $query = "select * from timetable where id=$id and day='$day' and slot = '$slot' limit 1";
    $result = mysqli_query($conn, $query);
    //echo "$id : $day : $slot";

    if (mysqli_num_rows($result)> 0) {
        $row = mysqli_fetch_assoc($result);
        $code = $row["subjectcode"];
        $sub_query = "select * from subjects where code = '$code'";
        $sub_result = mysqli_query($conn, $sub_query);
        $sub_row = mysqli_fetch_assoc($sub_result);

        $arr = array(
            "title" => $sub_row["title"],
            "code" => $row["subjectcode"],
            "venue" => $row["venue"],
            "color" => "<div class='accent-". $sub_row['color'] . "-gradient'>",
        );
        return $arr;
    } else return null;
}

function GetSubjects($conn) {
    $query = "select * from subjects order by code";
    $result = mysqli_query($conn, $query);

    return $result;
}

function GetSubjectByCode($conn, $code) {
    $query = "select * from subjects where code = '$code' limit 1";
    $result = mysqli_query($conn, $query);

    return $result;
}

function GetSchedule($conn, $day) {
    if (!isset($_SESSION['info'])) return null;

    $id = $_SESSION['info']['id'];
    $query = "select * from timetable where id=$id and day='$day'";
    $result = mysqli_query($conn, $query);

    return $result;
}

function AddSubject($conn, $code, $title, $color) {
    $query = "insert into subjects (code, title, color) values ('$code', '$title', '$color')";
    $result = mysqli_query($conn, $query);

    header("location: subjects.php");
    die;
}

function RemoveSubject($conn, $code) {
    $query = "delete from timetable where subjectcode='$code'";
    $result = mysqli_query($conn, $query);

    $query = "delete from subjects where code='$code'";
    $result = mysqli_query($conn, $query);
    
    header("location: subjects.php");
    die;
}

function AddSlot($conn, $day, $slot, $code, $venue) {
    $id = $_SESSION['info']['id'];
    $query = "insert into timetable (id, day, slot, subjectcode, venue) values ($id, '$day','$slot','$code','$venue');";
    $result = mysqli_query($conn, $query);

    header("location: index.php");
    die;
}

function RemoveSlot($conn, $day, $slot) {
    $id = $_SESSION['info']['id'];
    $query = "delete from timetable where id=$id and day='$day' and slot = '$slot'";
    $result = mysqli_query($conn, $query);

    header("location: index.php");
    die;
}

function EditSlot($conn, $day, $slot, $code, $venue) {
    $id = $_SESSION['info']['id'];
    $query = "update timetable set subjectcode = '$code', venue = '$venue' where id=$id and day='$day' and slot = '$slot'";
    $result = mysqli_query($conn, $query);

    header("location: index.php");
    die;
}

function EditSubject($conn, $code, $title, $color) {
    $query = "update subjects set title = '$title', color = '$color' where code = '$code'";
    $result = mysqli_query($conn, $query);

    header("location: subjects.php");
    die;
}
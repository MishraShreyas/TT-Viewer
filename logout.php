<?php

require_once("functions.php");

session_destroy();
session_unset();
session_regenerate_id();

header("location: login.php");
die;
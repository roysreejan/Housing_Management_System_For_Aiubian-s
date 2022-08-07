<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Admin') {
    header("Location: ../logout.php");
}


if (isset($_GET['uid'])) {
    // echo dirname(__FILE__, 2);
    if ($_GET['t'] == 'Student') {
        require_once("./StudentController.php");
        echo verifyStudent($_GET['uid']);
    } else if ($_GET['t'] == 'FlatOwner') {
        require_once("./HouseOwnerController.php");
        echo verifyHouseOwner($_GET['uid']);
    } else
        echo 0;
}

<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Admin') {
    header("Location: ../logout.php");
}

// echo '<pre>';
// var_dump($_GET);
// echo '</pre>';
// return;

if (isset($_GET['id'])) {
    if ($_GET['t'] == 'Student') {
        require_once("./StudentController.php");
        echo deleteStudent($_GET['id']);
        header("Location: ../students-list.php");
    } else if ($_GET['t'] == 'FlatOwner') {
        require_once("./HouseOwnerController.php");
        echo deleteHouseOwner($_GET['id']);
        header("Location: ../houseowners-list.php");
    } else if ($_GET['t'] == 'House') {
        require_once("./HouseController.php");
        echo deleteHouse($_GET['id']);
        header("Location: ../houses-list.php");
    } else {
        echo 0;
        header("Location: ../AdminDashboard.php");
    }
}

<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'FlatOwner') {
    header("Location: logout.php");
}

require_once('controller/HouseOwnerController.php');

?>
<?php include_once "header.php" ?>
<?php include_once "footer.php" ?>
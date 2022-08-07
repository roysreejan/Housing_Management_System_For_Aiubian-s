<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false && $_SESSION['type'] == 'Student') {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Student') {
    header("Location: logout.php");
}

if ($_SESSION['h_id'] === 'NULL') {
    header('Location: StudentDashboard.php');
}

require_once "controller/StudentController.php";

$hasError = false;

if (isset($_POST["leavehouse"])) {

    if (!$hasError) {

        if (leaveHouse($_SESSION['id'], $_SESSION['h_id'])) {
            $err_success = "Successfully Leave the house";
            $_SESSION['h_id'] = "NULL";
            header("Location: StudentDashboard.php");
        } else {
            $err_success = "Unsuccessfully Leave the house";
        }
    }
}

?>

<?php include_once "header.php" ?>

<div class="main">
    <form action="" method="post" id="leavehouse" onsubmit="">
        <fieldset>
            <legend>
                <h1>Leave House</h1>
            </legend>
            <table>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="leavehouse" value="Leave House">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>

<?php include_once "footer.php" ?>
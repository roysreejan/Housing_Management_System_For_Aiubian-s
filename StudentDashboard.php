<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false && $_SESSION['type'] == 'Student') {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Student') {
    header("Location: logout.php");
}

require_once "controller/StudentController.php";

$area = array("Bashundhara R/A", "Kuratoli", "Nikunjo");
$hasError = false;

$H_id = "";
$err_H_id = "";

$err_success = "";

if (isset($_POST["renthouse"])) {

    if (empty($_POST["H_id"])) {
        $hasError = true;
        $err_H_id = "House ID Number Required";
    } else if (is_numeric($_POST["H_id"]) == false) {
        $hasError = true;
        $err_H_id = "House ID number must contain number";
    } elseif (strlen($_POST["H_id"]) > 4) {
        $hasError = true;
        $err_H_id = "Not a valid House ID";
    } else {
        $H_id = htmlspecialchars($_POST["H_id"]);
    }

    if ($hasError === false) {
        if (rentHouse($_SESSION['id'], $H_id)) {
            $err_success = "Successfully Rented the house";
            $_SESSION['h_id'] = $H_id;
        } else {
            $err_success = "Unsuccessfully Rented the house";
        }
    }
}

?>

<?php include_once "header.php" ?>

<div class="main">
    <form action="" method="post" id="renthouse" onsubmit="">
        <fieldset>
            <legend>
                <h1>Rent House</h1>
            </legend>
            <table>
                <tr>
                    <td align="center" colspan="4"><span class="php-error"> <?php echo $err_success; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">House ID:</td>
                    <td><input type="text" name="H_id" value="<?php echo $H_id; ?>"></td>
                    <td><span> <?php echo $err_H_id; ?> </span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Rent House" name="renthouse">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>

<?php include_once "footer.php" ?>
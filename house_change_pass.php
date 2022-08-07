<?php
session_start();
include_once "header.php";
require_once "controller/HouseOwnerController.php";

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'FlatOwner') {
    header("Location: logout.php");
}

?>

<div class="main">
    <form action="" method="post" id="change-password" onsubmit="">
        <fieldset>
            <legend>
                <h1>Change Password</h1>
            </legend>
            <table>
                <tr>
                    <td align="center" colspan="4"><span class="php-error"> <?php echo $err_success; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">Previous Password:</td>
                    <td><input id="reg-prev-password" type="password" name="PrevPassword" value="<?php echo $PrevPassword; ?>"></td>
                    <td> <span id="js-error-prev-password"></span></td>
                    <td><span class="php-error"> <?php echo $err_PrevPassword; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">New Password:</td>
                    <td><input id="reg-password" type="password" name="Password" value="<?php echo $Password; ?>"></td>
                    <td> <span id="js-error-password"></span></td>
                    <td><span class="php-error"> <?php echo $err_Password; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">Confirm Password:</td>
                    <td><input id="reg-confirm-password" type="Password" name="ConfirmPassword" value="<?php echo $ConfirmPassword; ?>"></td>
                    <td> <span id="js-error-confirm-password"></span></td>
                    <td><span class="php-error"> <?php echo $err_ConfirmPassword; ?> </span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Submit" name="changepassword">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<script src="js/script.js"></script>
<?php include_once "footer.php" ?>
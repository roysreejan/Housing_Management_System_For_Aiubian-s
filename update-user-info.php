<?php 
session_start();
include_once "header.php";
require_once "controller/HouseController.php";


if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'FlatOwner') {
    header("Location: logout.php");
}

?>
<div class="main">
    <form action="" method="post" id="registration" onsubmit="return registrationValidation();">
        <fieldset>
            <legend>
                <h1>Registration</h1>
            </legend>
            <table>
                <tr>
                    <td align="center" colspan="4"><span class="php-error" style="color:red"> <?php echo $err_success; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">Name:</td>
                    <td><input id="reg-name" type="text" name="name" value="<?php echo $name; ?>"></td>
                    <td><span class="php-error"> <?php echo $err_name; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">Phone Number:</td>
                    <td><input id="reg-phone-number" type="text" name="phone" value="<?php echo $phone; ?>"></td>
                    <td><span class="php-error"> <?php echo $err_phone; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">AIUB-ID/NID:</td>
                    <td><input id="reg-aiub-id_nid" type="text" name="nid" value="<?php echo $nid; ?>"></td>
                    <td><span class="php-error"> <?php echo $err_nid; ?> </span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Update" name="updateprofile">
                    </td>
                </tr>

            </table>
        </fieldset>
    </form>
</div>

<?php include_once "footer.php" ?>
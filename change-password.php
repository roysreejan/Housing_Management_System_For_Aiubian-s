<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Student') {
    header("Location: logout.php");
}

$PrevPassword = "";
$err_PrevPassword = "";
$Password = "";
$err_Password = "";
$ConfirmPassword = "";
$err_ConfirmPassword = "";

$email = $_SESSION['email'];

$err_success = "";

$hasError = false;


if (isset($_POST["changepassword"])) {

    if (empty($_POST['PrevPassword'])) {
        $hasError = true;
        $err_PrevPassword = "Previous Password Required";
    } else {
        $PrevPassword = htmlspecialchars($_POST["PrevPassword"]);
    }

    if (empty($_POST["Password"])) {
        $hasError = true;
        $err_Password = "Password Required";
    } elseif (strlen($_POST["Password"]) <= 7) {
        $hasError = true;
        $err_Password = "Password must contain at least 8 character";
    } elseif (strpos($_POST["Password"], '#') == false && strpos($_POST['Password'], '?') == false) {
        $hasError = true;
        $err_Password = "Password must contain # character or one ? character";
    } else {
        $upper = 0;
        $lower = 0;
        $number = 0;
        $arr = str_split($_POST["Password"]);
        foreach ($arr as $a) {
            if (ctype_upper($a))
                $upper++;
            elseif (ctype_lower($a))
                $lower++;
            elseif (ctype_digit($a))
                $number++;
        }
        if ($upper >= 1 && $lower >= 1 && $number >= 1) {
            $Password = htmlspecialchars($_POST["Password"]);
        } else {
            $err_Password = "Password must contain 1 number and combination of uppercase and lowercase alphabet";
        }
    }

    if (empty($_POST["ConfirmPassword"])) {
        $hasError = true;
        $err_ConfirmPassword = "Confirm Password Required";
    } else if ($_POST["Password"] !== $_POST["ConfirmPassword"]) {
        $hasError = true;
        $err_ConfirmPassword = "Password and Confirm Password not match";
    } else {
        $ConfirmPassword = htmlspecialchars($_POST["ConfirmPassword"]);
    }

    if (!$hasError) {
        require_once "controller/StudentController.php";
        $operation = changeStudentPassword($email, $PrevPassword, $Password);

        if (!$operation) {
            $err_success = "Previous password didn't match";
        } else {
            $err_success = "Successfully change password";
        }
    }
}
?>

<?php include_once "header.php" ?>

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
                    <td><input id="reg-confirm-password" type="password" name="ConfirmPassword" value="<?php echo $ConfirmPassword; ?>"></td>
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

<?php include_once "header.php" ?>
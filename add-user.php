<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Admin') {
    header("Location: logout.php");
}
$Name = "";
$err_Name = "";
$Email = "";
$err_Email = "";
$Phone = "";
$err_Phone = "";
$Password = "";
$err_Password = "";
$ConfirmPassword = "";
$err_ConfirmPassword = "";
$type = "";
$err_type = "";
$id = "";
$err_id = "";

$err_success = "";

$hasError = false;

if (isset($_POST["registratoin"])) {
    if (empty($_POST["Name"])) {
        $hasError = true;
        $err_Name = "Name Required";
    } elseif (strlen($_POST["Name"]) <= 2) {
        $hasError = true;
        $err_Name = "Name must be greater than 2 characters";
    } else {
        $Name = htmlspecialchars($_POST["Name"]);
    }

    if (empty($_POST["Email"])) {
        $hasError = true;
        $err_Email = "Email Required";
    } else if (strpos($_POST["Email"], "@") == false || strpos($_POST["Email"], ".") == false) {
        $hasError = true;
        $err_Email = "Email must contain @ character and . character";
    } else {
        $Email = htmlspecialchars($_POST["Email"]);
    }

    if (empty($_POST["Phone"])) {
        $hasError = true;
        $err_Phone = "Phone number Required";
    } else if (is_numeric($_POST["Phone"]) == false) {
        $hasError = true;
        $err_Phone = "Phone number contain number";
    } else if (strlen($_POST["Phone"]) != 11) {
        $hasError = true;
        $err_Phone = "Phone number must contain at least 11 number";
    } else {
        $Phone = htmlspecialchars($_POST["Phone"]);
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

    if (!isset($_POST["type"])) {
        $hasError = true;
        $err_type = "User type Required";
    } else {
        $type = $_POST["type"];
    }

    if (empty($_POST["id"])) {
        $hasError = true;
        $err_id = "AIUB ID / National ID number Required";
    } elseif (is_numeric($_POST["id"]) == false) {
        $hasError = true;
        $err_id = "AIUB ID / National ID number must contain number";
    } else {
        $id = htmlspecialchars($_POST["id"]);
    }

    if (strlen($_POST["id"]) == 8 || strlen($_POST["id"]) == 10) {
        $err_id = "";
    } else {
        $err_id = "Not a valid id";
        $id = "";
    }

    if (!$hasError && $type == "Student") {

        require_once "./controller/StudentController.php";
        $data = false;

        if (getStudent($Email) === NULL) {
            $data = insertStudent($Name, $Email, $Phone, $Password, $id, "NULL");
            header("Location: index.php");
        } else {
            $err_success = "Duplicate email Registration unsuccessful";
        }
    } else if (!$hasError && $type == "FlatOwner") {

        require_once "./controller/HouseOwnerController.php";
        $data = false;

        if (getHouseOwner($Email) === NULL) {
            $data = insertHouseOwner($Name, $Email, $Phone, $Password, $id, "NULL");
            header("Location: index.php");
        } else {
            $err_success = "Duplicate email Registration unsuccessful";
        }
    }
}

?>

<?php include_once "header.php" ?>

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
                    <td><input id="reg-name" type="text" name="Name" value="<?php echo $Name; ?>"></td>
                    <td> <span id="js-error-name"></span></td>
                    <td><span class="php-error"> <?php echo $err_Name; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">Email:</td>
                    <td><input id="reg-email" type="text" name="Email" value="<?php echo $Email; ?>"></td>
                    <td> <span id="js-error-email"></span></td>
                    <td><span class="php-error"> <?php echo $err_Email; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">Phone Number:</td>
                    <td><input id="reg-phone-number" type="text" name="Phone" value="<?php echo $Phone; ?>"></td>
                    <td> <span id="js-error-phone-number"></span></td>
                    <td><span class="php-error"> <?php echo $err_Phone; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">Password:</td>
                    <td><input id="reg-password" type="Password" name="Password" value="<?php echo $Password; ?>"></td>
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
                    <td align="right">User type: </td>
                    <td>
                        <input id="student" type="radio" value="Student" <?php if ($type == "Student") echo "checked"; ?> name="type"> <label for="student">Student</label>
                        <input id="flat-owner" type="radio" value="FlatOwner" <?php if ($type == "FlatOwner") echo "checked"; ?> name="type"> <label for="flat-owner">Flat Owner</label>
                    </td>
                    <td> <span id="js-error-type"></span></td>
                    <td><span class="php-error"> <?php echo $err_type; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">AIUB-ID/NID:</td>
                    <td><input id="reg-aiub-id_nid" type="text" name="id" value="<?php echo $id; ?>"></td>
                    <td> <span id="js-error-aiubid_nid"></span></td>
                    <td><span class="php-error"> <?php echo $err_id; ?> </span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Signup" name="registratoin">
                    </td>
                </tr>

            </table>
        </fieldset>
    </form>
</div>

<?php include_once "footer.php" ?>
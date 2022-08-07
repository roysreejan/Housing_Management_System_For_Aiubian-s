<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Student') {
    header("Location: logout.php");
}

$Name = $_SESSION['name'];
$err_Name = "";
$Phone = $_SESSION['phone'];
$err_Phone  = "";
$id = $_SESSION['aiub_nid_id'];
$err_id = "";

$err_success = "";

$hasError = false;

if (isset($_POST["updateprofile"])) {
    if (empty($_POST["Name"])) {
        $hasError = true;
        $err_Name = "Name Required";
    } elseif (strlen($_POST["Name"]) <= 2) {
        $hasError = true;
        $err_Name = "Name must be greater than 2 characters";
    } else {
        $Name = htmlspecialchars($_POST["Name"]);
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

    if (!$hasError) {
        require_once "./controller/StudentController.php";
        $data = false;

        $data = updateProfile($_SESSION['id'], $Name, $Phone, $id, "NULL");

        if ($data == false) {
            $err_success = "Duplicate email!! unsuccessful updating profile";
        } else {
            $_SESSION['name'] = $Name;
            $_SESSION['phone'] = $Phone;
            $_SESSION['aiub_nid_id'] = $id;
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
                    <td><span class="php-error"> <?php echo $err_Name; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">Phone Number:</td>
                    <td><input id="reg-phone-number" type="text" name="Phone" value="<?php echo $Phone; ?>"></td>
                    <td><span class="php-error"> <?php echo $err_Phone; ?> </span></td>
                </tr>
                <tr>
                    <td align="right">AIUB-ID/NID:</td>
                    <td><input id="reg-aiub-id_nid" type="text" name="id" value="<?php echo $id; ?>"></td>
                    <td><span class="php-error"> <?php echo $err_id; ?> </span></td>
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
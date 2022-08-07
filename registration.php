<?php 
	include_once "header.php"; 
	require_once 'controller/UserController.php';	
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
<script src="js/script.js"></script>
<?php include_once "footer.php" ?>
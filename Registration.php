<?php
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

$hasError = false;

if (isset($_POST["submit"])) 
{
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
	} 
	else if(strpos($_POST["Email"], "@"))
	{
		$flag = false;
		$pos = strpos($_POST["Email"], "@");
		$str = $_POST["Email"];
		for($i = $pos; $i < strlen($str); $i++)
		{
			if($str[$i]== ".")
			{
				$flag = true;
				break;
			}	
		}
		if($flag == true)
		{
			$Email=htmlspecialchars($_POST["Email"]);
		}
		else
		{
			$hasError = true;
			$err_Email="Email must contain @ character and . character";
		}
    }
	else 
	{
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
		$err_id = "AIUB ID / National ID Number Required";
	} elseif (is_numeric($_POST["id"]) == false) {
		$hasError = true;
		$err_id = "ID number must contain number";
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
        header("Location: login.php");
    } elseif (!$hasError && $type == "FlatOwner") {
        header("Location: login.php");
    }
}

?>
<html>

<body style="width: 40%;">
	<form action="" method="post">
		<fieldset>
			<legend>
				<h1>Registration</h1>
			</legend>
			<table>
				<tr>
					<td align="right">Name:</td>
					<td><input type="text" name="Name" value="<?php echo $Name; ?>"></td>
					<td><span> <?php echo $err_Name; ?> </span></td>
				</tr>
				<tr>
					<td align="right">Email:</td>
					<td><input type="text" name="Email" value="<?php echo $Email; ?>"></td>
					<td><span> <?php echo $err_Email; ?> </span></td>
				</tr>
				<tr>
					<td align="right">Phone Number:</td>
					<td><input type="text" name="Phone" value="<?php echo $Phone; ?>"></td>
					<td><span> <?php echo $err_Phone; ?> </span></td>
				</tr>
				<tr>
					<td align="right">Password:</td>
					<td><input type="Password" name="Password" value="<?php echo $Password; ?>"></td>
					<td><span> <?php echo $err_Password; ?> </span></td>
				</tr>
				<tr>
					<td align="right">Confirm Password:</td>
					<td><input type="Password" name="ConfirmPassword" value="<?php echo $ConfirmPassword; ?>"></td>
					<td><span> <?php echo $err_ConfirmPassword; ?> </span></td>
				</tr>
				<tr>
					<td align="right">User type: </td>
					<td>
						<input type="radio" value="Student" <?php if ($type == "Student") echo "checked"; ?> name="type"> Student
						<input type="radio" value="FlatOwner" <?php if ($type == "FlatOwner") echo "checked"; ?> name="type"> Flat Owner
					</td>
					<td><span> <?php echo $err_type; ?> </span></td>
				</tr>
				<tr>

					<td align="right">AIUB-ID/NID:</td>
					<td><input type="text" name="id" value="<?php echo $id; ?>"></td>
					<td><span> <?php echo $err_id; ?> </span></td>

				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="Signup" name="submit"> <span><a href="Login.php"><input type=button value="Login"></a></span>
					</td>
				</tr>

			</table>
		</fieldset>
	</form>
</body>

</html>
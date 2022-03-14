<?php

$name = "";
$err_name = "";
$email = "";
$err_email = "";
$contactnumber = "";
$err_contactnumber = "";
$address = "";
$err_address = "";
$usertype = "";
$err_usertype = "";
$helpmessage = "";
$err_helpmessage = "";
$urgent = "";
$err_urgent = "";

if (isset($_POST["helpSubmit"])) {

	$name = htmlspecialchars($_POST["name"]);
	$err_name = "";
	$email = htmlspecialchars($_POST["email"]);
	$err_email = "";
	$contactnumber = htmlspecialchars($_POST['contactnumber']);
	$err_contactnumber = "";
	$address = htmlspecialchars($_POST["address"]);
	$err_address = "";
	$usertype = (isset($_POST["usertype"])) ? htmlspecialchars($_POST["usertype"]) : "";
	$err_usertype = "";
	$helpmessage = htmlspecialchars($_POST["helpmessage"]);
	$err_helpmessage = "";
	$urgent = (isset($_POST["urgent"])) ? htmlspecialchars($_POST["urgent"]) : "";
	$err_urgent = "";

	if (empty($name)) {
		$err_name = "Name Required";
	} else if (strlen($name) <= 2) {
		$err_name = "Name must be greater than 2 characters";
	}

	if (empty($email)) {
		$err_email = "Email Required";
	}
	 else if(strpos($_POST["email"], "@"))
	{
		$flag = false;
		$pos = strpos($_POST["email"], "@");
		$str = $_POST["email"];
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
			$email=htmlspecialchars($_POST["email"]);
		}
		else
		{
			$hasError = true;
			$err_email="Email must contain @ character and . character";
		}
    }

	if (empty($contactnumber)) {
		$err_contactnumber = "Contact Number Required";
	} else if (is_numeric($contactnumber) == false) {
		$err_contactnumber = "Phone number contain number";
	} else if (strlen($contactnumber) != 11) {
		$err_contactnumber = "Phone number contain number";
	}

	if (empty($address)) {
		$err_address = "Address Required";
	}

	if (empty($usertype)) {
		$err_usertype = "User Type Required";
	}

	if (empty($helpmessage)) {
		$err_helpmessage = "Message is Required";
	}

	if (empty($urgent)) {
		$err_urgent = "Urgent options is Required";
	}
}
?>
<!doctype html>
<html>

<head>
	<title>Help Center</title>
</head>

<body style="width: 40%;">
	<form action="" method="post">
		<fieldset>
			<legend>
				<h1>Help</h1>
			</legend>
			<table>
				<tr>
					<td align="right">Name: </td>
					<td><input name="name" type="text" value="<?php echo (empty($err_name)) ? $name : ""; ?>"><br>
					<td><?php echo $err_name; ?></td>
				</tr>
				<tr>
					<td align="right">E-mail:</td>
					<td><input name="email" type="text" value="<?php echo (empty($err_email)) ? $email : ""; ?>"><br>
					<td><?php echo $err_email; ?></td>
				</tr>
				<tr>
					<td align="right">Contact Number:</td>
					<td><input name="contactnumber" type="text" value="<?php echo (empty($err_contactnumber)) ? $contactnumber : ""; ?>"><br>
					<td><?php echo $err_contactnumber; ?></td>
				</tr>
				<tr>
					<td align="right">Address:</td>
					<td><textarea name="address"><?php echo (empty($err_address)) ? $address : ""; ?></textarea><br /></td>
					<td><?php echo $err_address; ?></td>
				</tr>
				<tr>
					<td align="right">User type</td>
					<td>
						<input type="radio" value="admin" name="usertype" <?php echo ($usertype === "admin") ? "checked" : ""; ?>>Admin <br>
						<input type="radio" value="student" name="usertype" <?php echo ($usertype === "student") ? "checked" : ""; ?>>Student <br>
						<input type="radio" value="flatowner" name="usertype" <?php echo ($usertype === "flatowner") ? "checked" : ""; ?>>Flat Owner<br>
					</td>
					<td><?php echo $err_usertype; ?></td>
				</tr>
				<tr>
					<td align="right">Reason for asking help?</td>
					<td><textarea name="helpmessage"><?php echo (empty($err_helpmessage)) ? $helpmessage : ""; ?></textarea><br /></td>
					<td><?php echo $err_helpmessage; ?></td>
				</tr>
				<tr>
					<td align="right">Is it, urgent?</td>
					<td>
						<input type="radio" value="yes" name="urgent" <?php echo ($urgent === "yes") ? "checked" : ""; ?>>Yes<br>
						<input type="radio" value="no" name="urgent" <?php echo ($urgent === "no") ? "checked" : ""; ?>>No<br>
					</td>
					<td><?php echo $err_urgent; ?></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="Ask for help!!!!" name="helpSubmit">
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>

</html>
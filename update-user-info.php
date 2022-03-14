<?php

$Name = "";
$err_Name = "";
$Email = "";
$err_Email = "";
$Phone = "";
$err_Phone = "";

$hasError = false;


if (isset($_POST["submit"])) {
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
		$Email = $_POST["Email"];
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
		$Phone = $_POST["Phone"];
	}
}
?>



<html>

<body style="width: 40%;">
	<form action="" method="post">
		<fieldset>
			<legend>
				<h1>Update User Info</h1>
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
					<td></td>
					<td>
						<input type="submit" value="Submit" name="submit">
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>
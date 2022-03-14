<?php
$Name = "";
$err_Name = "";
$id = "";
$err_id = "";
$ad = "";
$err_ad = "";
$fb = "";
$err_fb = "";

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

	if (empty($_POST["id"])) {
		$hasError = true;
		$err_id = "Student ID Number Required";
	} else if (is_numeric($_POST["id"]) == false) {
		$hasError = true;
		$err_id = "ID number must contain number";
	} elseif (strlen($_POST["id"]) > 10) {
		$hasError = true;
		$err_id = "Not a valid ID";
	} else {
		$id = htmlspecialchars($_POST["id"]);
	}
	if (empty($_POST["ad"])) {
		$hasError = true;
		$err_ad = "Address Required";
	} else {
		$ad = htmlspecialchars($_POST["ad"]);
	}

	if (empty($_POST["fb"])) {
		$hasError = true;
		$err_fb = "Feedback Required";
	} else {
		$fb = htmlspecialchars($_POST["fb"]);
	}
}

?>
<html>

<head></head>

<body style="width: 40%;">
	<form action="" method="post">
		<fieldset>
			<legend>
				<h1>Leave House</h1>
			</legend>
			<table>
				<tr>
					<td align="right">Student Name:</td>
					<td><input type="text" name="Name" value="<?php echo $Name; ?>"></td>
					<td><span> <?php echo $err_Name; ?> </span></td>
				</tr>
				<tr>
					<td align="right">Student ID::</td>
					<td><input type="text" name="id" value="<?php echo $id; ?>"></td>
					<td><span> <?php echo $err_id; ?> </span></td>
				</tr>
				</tr>
				<tr>
					<td align="right">House Address: </td>
					<td><textarea name="ad"><?php echo $ad; ?></textarea>
					<td><span> <?php echo $err_ad; ?> </span></td>
				</tr>
				<tr>
					<td align="right">Feedback: </td>
					<td><textarea name="fb"><?php echo $fb; ?></textarea>
					<td><span> <?php echo $err_fb; ?> </span></td>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>

</html>
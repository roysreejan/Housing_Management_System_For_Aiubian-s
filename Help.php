<?php
	require_once 'header.php';
	require_once 'controller/UserController.php';
?>
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
					<td align="right">Address:</td>
					<td><input type="text" name="Address" value="<?php echo $Address; ?>"></td>
					<td><span> <?php echo $err_Address; ?> </span></td>
				</tr>
				<tr>
					<td align="right">User type</td>
					<td>
						<input type="radio" value="admin" name="type" <?php echo ($type === "admin") ? "checked" : ""; ?>>Admin <br>
						<input type="radio" value="student" name="type" <?php echo ($type === "student") ? "checked" : ""; ?>>Student <br>
						<input type="radio" value="flatowner" name="type" <?php echo ($type === "flatowner") ? "checked" : ""; ?>>Flat Owner<br>
					</td>
					<td><?php echo $err_type; ?></td>
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
<? require_once 'footer.php'; ?>
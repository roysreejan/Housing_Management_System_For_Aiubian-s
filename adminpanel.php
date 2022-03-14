<?php
	$Search="";
	$err_Search="";
	$Delete="";
	$err_Delete="";
	
	$hasError=false;
	
	if(isset($_POST["submit1"]))
	{
		if(empty($_POST["Search"])){
			$hasError = true;
			$err_Search="Search Required";
		}
		else
		{
			$Search=htmlspecialchars($_POST["Search"]);
		}
	}
	if(isset($_POST["submit2"]))
	{
		if(empty($_POST["Delete"])){
			$hasError = true;
			$err_Delete="Delete Required";
		}
		else
		{
			$Delete=htmlspecialchars($_POST["Delete"]);
		}
	}
?>
<html>
	<head>
		<title>Admin Panel</title>
	</head>
	<body>
		<form action="" method="post">
			<fieldset>
				<legend><h1>Admin Panel</h1></legend>
				<table>
					<tr>
						<td align="right">Search User:</td>
						<td><input type="text" name="Search" value="<?php echo $Search; ?>"></td>
						<td><span> <?php echo $err_Search;?> </span></td>
						<td colspan="2"><input type="submit" name="submit1" value="Search"></td>
					</tr>
					<tr>
						<td align="right">Delete User:</td>
						<td><input type="text" name="Delete" value="<?php echo $Delete; ?>"></td>
						<td><span> <?php echo $err_Delete;?> </span></td>
						<td colspan="2"><input type="submit" name="submit2" value="Delete"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><br><a href="complaint.php"><input type=button value="Complaint"></a></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</body>
</html>
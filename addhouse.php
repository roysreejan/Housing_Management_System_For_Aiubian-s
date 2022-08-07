<?php
session_start(); 
	include 'header.php';
	require_once 'controller/HouseController.php';

	
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'FlatOwner') {
    header("Location: logout.php");
}	
?>
<html>
	<head>
		<title>Add House</title>
	</head>
	<body>
	<h5><?php echo $err_db;?></h5>
		<form action="" method="post" enctype="multipart/form-data" id="addHouse" onsubmit="return addhouseValidation();">
			<fieldset>
				<legend><h1>Add House</h1></legend>
				<table>
				<tr>
                    <td align="center" colspan="4"><span class="php-error" style="color:red"> <?php echo $err_success; ?> </span></td>
                </tr>
					<tr>
                    <td align="right">House Name:</td>
                    <td><input id="h-name" type="text" name="name" value="<?php echo $name; ?>"></td>
                    <td> <span id="js-error-name"></span></td>
                    <td><span class="php-error"> <?php echo $err_name; ?> </span></td>
                </tr>
					<tr>
					<td align="right">Address:</td>
					<td><select name="address">
							<option selected disabled>--Select--</option>
							<?php
								foreach($area as $a)
								{
									if($a == $address)
										echo "<option selected>$a</option>";
									else
										echo "<option>$a</option>";
								}
							?>
						</select> 
						<td> <span id="js-error-type"></span></td>
						<td><span class="php-error"><?php echo $err_address;?></span></td>
					</td>
					</tr>
					<tr>
						<td align="right">Status: </td>
						<td>
							<input id=available type="radio" value="Available" <?php if($status=="Available") echo "checked"; ?> name="status"> Available
							<input id=not_available name="status" <?php if($status=="Not available") echo "checked"; ?> value="Not available" type="radio"> Not available </td> 
						</td>
						<td> <span id="js-error-type"></span></td>
						<td><span class="php-error"> <?php echo $err_status; ?> </span></td>
					</tr>
						<tr>
						<td align="right">Price:</td>
						<td><input id="h-price" type="text" name="price" value="<?php echo $price; ?>"></td>
						<td> <span id="js-error-name"></span></td>
						<td><span class="php-error"> <?php echo $err_price; ?> </span></td>
					</tr>
					<tr>
						<td align="right">Image:</td>
						<td><input type="file" name="h_image"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><br><input type="submit" name="addHouse" value="Add House"></td>
					</tr>
				</table>	
			</fieldset>
		</form>
	</body>
</html>
<script src="js/house.js"></script>
<?php require_once 'footer.php';?>
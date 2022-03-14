<?php
$area = array("Bashundhara R/A", "Kuratoli", "Nikunjo");
$H_id = "";
$err_H_id = "";
$SelectArea = "";
$err_SelectArea = "";
$Facilities = [];
$err_Facilities = "";
$Highprice = "";
$err_price = "";
$Lowprice = "";

$Source = [];
$err_Source = "";
$hasError = false;

function FacilitiesExist($f)
{
	global $Facilities;
	foreach ($Facilities as $Facility) {
		if ($f == $Facility)
			return true;
	}
	return false;
}

if (isset($_POST["submit"])) {
	if (empty($_POST["H_id"])) {
		$hasError = true;
		$err_H_id = "House ID Number Required";
	} else if (is_numeric($_POST["H_id"]) == false) {
		$hasError = true;
		$err_H_id = "House ID number must contain number";
	} elseif (strlen($_POST["H_id"]) > 4) {
		$hasError = true;
		$err_H_id = "Not a valid House ID";
	} else {
		$H_id = htmlspecialchars($_POST["H_id"]);
	}
	if (!isset($_POST["SelectArea"])) {
		$hasError = true;
		$err_SelectArea = "Area Required";
	} else {
		$SelectArea = $_POST["SelectArea"];
	}
	if (!isset($_POST["Facilities"])) {
		$hasError = true;
		$err_Facilities = "Facilities Required";
	} else {
		$Facilities = $_POST["Facilities"];
	}
	if (empty($_POST["Highprice"]) || empty($_POST["Lowprice"])) {
		$hasError = true;
		$err_price = "Price Range Required";
	} else if (is_numeric($_POST["Highprice"]) == false && is_numeric($_POST["Lowprice"]) == false) {
		$hasError = true;
		$err_price = "Price Range must contain number";
	} else if ((int)($_POST["Highprice"]) < 0 || (int)($_POST["Lowprice"]) < 0) {
		$hasError = true;
		$err_price = "Price Range must be positive";
	} else if (($_POST["Highprice"]) < ($_POST["Lowprice"])) {
		$hasError = true;
		$err_price = "Low price should be lower than High Price";
	} else {
		$Highprice = htmlspecialchars($_POST["Highprice"]);
		$Lowprice = htmlspecialchars($_POST["Lowprice"]);
	}
}

?>
<html>

<head></head>

<body style="width: 40%;">
	<form action="" method="post">
		<fieldset>
			<legend>
				<h1>Rent House</h1>
			</legend>
			<table>
				<tr>
					<td align="right">House ID:</td>
					<td><input type="text" name="H_id" value="<?php echo $H_id; ?>"></td>
					<td><span> <?php echo $err_H_id; ?> </span></td>
				</tr>
				<tr>
					<td align="right">Select Area:</td>
					<td><select name="SelectArea">
							<option selected disabled>--Select--</option>
							<?php
							foreach ($area as $a) {
								if ($a == $SelectArea)
									echo "<option selected>$a</option>";
								else
									echo "<option>$a</option>";
							}
							?>
						</select> <br><span><?php echo $err_SelectArea; ?></span>
					</td>
				</tr>

				<tr>
					<td align="right">Price Range: </td>
					<td><input style="width: 114px" type="text" placeholder="Lowprice" name="Lowprice" value="<?php echo $Lowprice; ?>"> - <input placeholder="Highprice" style="width:114px" type="text" name="Highprice" value="<?php echo $Highprice; ?>"> Taka</td>
					<td><span> <?php echo $err_price; ?> </span></td>
				</tr>

				<tr>
					<td align="right">Facilities:</td>
					<td>
						<input type="checkbox" value="Wifi" <?php if (FacilitiesExist("Wifi")) echo "checked"; ?> name="Facilities[]">Wifi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" value="Elavator" <?php if (FacilitiesExist("Elavator")) echo "checked"; ?> name="Facilities[]">Elavator
						<br>
						<input type="checkbox" value="Washing" <?php if (FacilitiesExist("Washing")) echo "checked"; ?> name="Facilities[]">Washing
						<input type="checkbox" value="Gas" <?php if (FacilitiesExist("Gas")) echo "checked"; ?> name="Facilities[]">Gas
						<br>
						<input type="checkbox" value="Garage" <?php if (FacilitiesExist("Garage")) echo "checked"; ?> name="Facilities[]">Garage &nbsp;
						<input type="checkbox" value="Ac Room" <?php if (FacilitiesExist("Ac Room")) echo "checked"; ?> name="Facilities[]">Ac Room
						<br>
						<span><?php echo $err_Facilities; ?></span>
					</td>
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
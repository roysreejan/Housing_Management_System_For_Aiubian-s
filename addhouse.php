<?php
	$Name="";
	$err_Name="";
	$Email="";
    $err_Email="";
	$Phone="";
	$err_Phone="";
	$SelectArea="";
	$err_SelectArea="";
	$Facilities=[];
	$err_Facilities="";

	
	$hasError=false;
	
	function FacilitiesExist($f)
	{
		global $Facilities;
		foreach($Facilities as $Facility){
			if ($f == $Facility) 
			return true;
		}
		return false;
	}

	$area = array("Bashundhara R/A","Kuratoli","Nikunjo");
	
	
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["Name"])){
			$hasError = true;
			$err_Name="Name Required";
		}
		elseif(strlen($_POST["Name"]) <=2)
		{
			$hasError = true;
			$err_Name = "Name must be greater than 2 characters";
		}
		else
		{
			$Name=htmlspecialchars($_POST["Name"]);
		}
		if(empty($_POST["Email"]))
		{
			$hasError = true;
			$err_Email="Email Required";
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
            $Email=$_POST["Email"];
        }
        if(empty($_POST["Phone"]))
		{
			$hasError = true;
			$err_Phone="Phone number Required";
		}
        else if(is_numeric($_POST["Phone"]) == false)
		{
            $hasError = true;
			$err_Phone="Phone number must contain number";
        }
		elseif(strlen($_POST["Phone"]) < 11)
		{
			$hasError = true;
			$err_Phone="Phone number must contain at least 11 number";
		}
        else
		{
            $Phone=$_POST["Phone"];
        }
		if(!isset($_POST["SelectArea"])){
			$hasError = true;
			$err_SelectArea= "Area Required";
		}
		else
		{
			$SelectArea = $_POST["SelectArea"];
		}
		if(!isset($_POST["Facilities"]))
		{
			$hasError = true;
			$err_Facilities = "Facilities Required";
		}
		else
		{
			$Facilities = $_POST["Facilities"];
		}	
	}	
?>
<html>
	<head>
		<title>Add House</title>
	</head>
	<body>
		<form action="" method="post">
			<fieldset>
				<legend><h1>Add House</h1></legend>
				<table>
					<tr>
						<td align="right">Name:</td>
						<td><input type="text" name="Name" value="<?php echo $Name; ?>"></td>
						<td><span> <?php echo $err_Name;?> </span></td>
					</tr>
					<tr>
						<td align="right">Email:</td>
						<td><input type="text" name="Email" value="<?php echo $Email; ?>"></td>
						<td><span> <?php echo $err_Email;?> </span></td>
					</tr>
					<tr>
						<td align="right">Phone Number:</td>
						<td><input type="text" name="Phone" value="<?php echo $Phone; ?>"></td>
						<td><span> <?php echo $err_Phone;?> </span></td>
					</tr>
					<tr>
					<td align="right">Select Area:</td>
					<td><select name="SelectArea">
							<option selected disabled>--Select--</option>
							<?php
								foreach($area as $a)
								{
									if($a == $SelectArea)
										echo "<option selected>$a</option>";
									else
										echo "<option>$a</option>";
								}
							?>
						</select> <br><span><?php echo $err_SelectArea;?></span>
					</td>
					</tr>
					<tr>
					<td align="right">Facilities:</td>
					<td>
						<input type="checkbox" value="Wifi" <?php if(FacilitiesExist("Wifi")) echo "checked";?> name="Facilities[]">Wifi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" value="Elavator" <?php if(FacilitiesExist("Elavator")) echo "checked";?> name="Facilities[]">Elavator
						<br> 
						<input type="checkbox" value="Washing" <?php if(FacilitiesExist("Washing")) echo "checked";?> name="Facilities[]">Washing 
						<input type="checkbox" value="Gas" <?php if(FacilitiesExist("Gas")) echo "checked";?> name="Facilities[]">Gas
						<br>
						<input type="checkbox" value="Garage" <?php if(FacilitiesExist("Garage")) echo "checked";?> name="Facilities[]">Garage &nbsp;
						<input type="checkbox" value="Ac Room" <?php if(FacilitiesExist("Ac Room")) echo "checked";?> name="Facilities[]">Ac Room
						<br>
						<span><?php echo $err_Facilities;?></span></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><br><input type="submit" name="submit" value="Submit"></td>
					</tr>
				</table>	
			</fieldset>
		</form>
	</body>
</html>
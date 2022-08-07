<?php include 'header.php';
	require_once 'controller/HouseController.php';
	$houses=getAllHouses();
	$id = $_GET["id"];
	$h= getHouse($ho_id,$status);
?>
<!--editproduct starts -->
<html>
	<head></head>
	<h5><?php echo $err_db;?></h5>
    <body>
		<form  method="post" action="">
		<fieldset>
			<legend><h1>Edit House</h1></legend>
			<table>
				<tr>
					<td align="right">House Name:</td> 
					<td><input type="hidden" name="id" value="<?php echo $h["id"]; ?>" >
						<input type="text" name="name" value="<?php echo $h["name"]; ?>" ></td>
					<td><span> <?php echo $err_name;?> </span></td>
				</tr>
				<tr>
					<td align="right">Address:</td> 
						<td><select name="address" value="<?php echo $h["address"]; ?>">
						<option selected disabled>Choose</option>
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
						<td><span><?php echo $err_address;?></span></td>
				</tr>
				<tr>
					<td align="right">Status:</td> 
						<td><input type="radio" value="Available" <?php if($status=="Available") echo $h["checked"]; ?> name="status"> Available
						<input name="status" <?php if($status=="Not available") echo $h["checked"]; ?> value="Not available" type="radio"> Not available
						</td>
						<td><span> <?php echo $err_status;?> </span></td>
				</tr>
				<tr>
					<td align="right">Price:</td> 
					<td><input type="text" value ="<?php echo $h["price"];?>"></td>
					<td><span><?php echo $err_price;?></span></td>
				</tr>
				<tr>
					<td align="right">Image</td> 
					<td><input type="file" class="form-control"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" class="btn btn-success" value="Edit House" ></td>
				</tr>
			</table>				
		</fieldset>
		</form>
    </body>
</html>
<!--editproduct ends -->
<?php include 'footer.php';?>
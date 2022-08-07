<?php
	require_once "model/db_config.php";
	
	$name="";
	$err_name="";
	$address="";
	$err_address="";
	$status="";
	$err_status="";
	$price="";
	$err_price="";
	$img="";
	$ho_id="";
	$target="";
	$success="";
	$err_success="";
	$phone="";
	$err_phone="";
	$nid="";
	$err_nid="";
	$email="";
	$err_email="";
	$hasError=false;
	$err_db="";

	$area = array("Bashundhara R/A","Kuratoli","Nikunjo");
	
	
	if(isset($_POST["addHouse"]))
	{	
		if(empty($_POST["name"])){
			$hasError = true;
			$err_name="Name Required";
		}
		elseif(strlen($_POST["name"]) <=2)
		{
			$hasError = true;
			$err_name = "Name must be greater than 2 characters";
		}
		else
		{
			$name= $_POST["name"];
		}
		
		if(!isset($_POST["address"])){
			$hasError = true;
			$err_address= "Address Required";
		}
		else
		{
			$address = $_POST["address"];
		}
		if(!isset($_POST["status"]))
		{
			$hasError = true;
			$err_status="Status Required";
		}
		else
		{
			$status = $_POST["status"];
		}
		if(empty($_POST["price"])){
			$hasError = true;
			$err_price="Price Required";
		}
		else
		{
			$price=htmlspecialchars($_POST["price"]);
		}
		
		$fileType = strtolower(pathinfo(basename($_FILES["h_image"]["name"]),PATHINFO_EXTENSION));
		$target = "storage/house_image/".uniqid().".$fileType";
		move_uploaded_file($_FILES["h_image"]["tmp_name"],$target);
		
		if(!$hasError)
		{
			$result = insertHouse($name, $address, $price, $status ,$img, $ho_id, $target);
			if($result===true)
			{
				header("location:allhouse.php");
			}
			$err_db=$result;
		}
	}
	elseif(isset($_POST["edithouse"]))
	{
		if(empty($_POST["name"])){
			$hasError = true;
			$err_name="Name Required";
		}
		elseif(strlen($_POST["name"]) <=2)
		{
			$hasError = true;
			$err_name = "Name must be greater than 2 characters";
		}
		else
		{
			$name= $_POST["name"];
		}
		
		if(!isset($_POST["address"])){
			$hasError = true;
			$err_address= "Address Required";
		}
		else
		{
			$address = $_POST["address"];
		}
		if(!isset($_POST["status"]))
		{
			$hasError = true;
			$err_status="Status Required";
		}
		else
		{
			$status = $_POST["status"];
		}
		if(empty($_POST["price"])){
			$hasError = true;
			$err_price="Price Required";
		}
		else
		{
			$price=htmlspecialchars($_POST["price"]);
		}
		if(!$hasError)
		{
			$result = updateHouse($name, $address, $price, $status ,$img, $ho_id);
			if($result===true)
			{
				header("location:allhouse.php");
			}
			$err_db=$result;
		}
	}
	elseif(isset($_POST["SearchHouse"]))
	{
		if(empty($_POST["name"])){
			$hasError = true;
			$err_name="Name Required";
		}
		elseif(strlen($_POST["name"]) <=2)
		{
			$hasError = true;
			$err_name = "Name must be greater than 2 characters";
		}
		else
		{
			$name= $_POST["name"];
		}
		
		if(!isset($_POST["address"])){
			$hasError = true;
			$err_address= "Address Required";
		}
		else
		{
			$address = $_POST["address"];
		}
		if(!isset($_POST["status"]))
		{
			$hasError = true;
			$err_status="Status Required";
		}
		else
		{
			$status = $_POST["status"];
		}
		if(empty($_POST["price"])){
			$hasError = true;
			$err_price="Price Required";
		}
		else
		{
			$price=htmlspecialchars($_POST["price"]);
		}
		if(!$hasError)
		{
			$result = searchHouse($name, $address, $price, $status ,$img, $ho_id);
			if($result===true)
			{
				header("location:allhouse.php");
			}
			$err_db=$result;
		}
	}


function insertHouse($name, $address, $price, $status, $img, $ho_id)
{
    $query = "INSERT INTO houses VALUES (NULL, '$name', '$address', '$price', '$status', '$img', '$ho_id')";

    return execute($query);
}

function getAllHouses()
{
    $query = "SELECT h.*, ho.name as 'h_name' FROM houses h left join house_owners ho on h.ho_id= h.id";
    $result = get($query);
    return $result;
}

function getHouse($ho_id, $status)
{
    $query = "SELECT * FROM houses WHERE id = '$ho_id' and status= '$status'";
    $result = get($query);
    if (count($result) === 0)
        return NULL;
    return $result[0];
}

function getAvailableHouses($name, $address)
{
    $query = "SELECT * FROM houses WHERE name LIKE '%$name%' and address = '$address' and status = 0";
    $result = get($query);
    if (count($result) === 0)
        return NULL;
    return $result;
}

function updateHouse($id, $name, $address, $price, $status, $ho_id)
{
    $query = "update houses set name = '$name', address = '$address', price = '$price', status = $status, ho_id= '$ho_id' WHERE id = $id";
    return execute($query);
}

function deleteHouse($id)
{
    $query = "DELETE FROM houses WHERE id = '$id'";
    return execute($query);
}
function searchHouse($key)
{
	$query = "select h.id,h.name,h.address,h.price,h.status from houses h where h.name like '%$key%'";
	$result = get($query);
	return $rs;
}

?>
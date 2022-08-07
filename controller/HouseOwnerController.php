<?php

	require_once "model/db_config.php";
	$name="";
	$err_name="";
	$email="";
	$err_email="";
	$phone="";
	$err_phone="";
	$password = "";
	$err_password = "";
	$nid="";
	$err_nid="";
	$PrevPassword = "";
	$err_PrevPassword = "";
	$Password = "";
	$err_Password = "";
	$ConfirmPassword = "";
	$err_ConfirmPassword = "";
	$success="";
	$err_success="";
	$hasError=false;
	$err_db="";
	
	if(isset($_POST["addHouseOwner"]))
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
		if (empty($_POST["email"])) {
        $hasError = true;
        $err_email = "Email Required";
		} else if (strpos($_POST["email"], "@") == false || strpos($_POST["email"], ".") == false) {
			$hasError = true;
			$err_email = "Email must contain @ character and . character";
		} else {
			$email = htmlspecialchars($_POST["email"]);
		}
		if (empty($_POST["phone"])) {
        $hasError = true;
        $err_phone = "Phone number Required";
		} else if (is_numeric($_POST["phone"]) == false) {
			$hasError = true;
			$err_phone = "Phone number contain number";
		} else if (strlen($_POST["phone"]) != 11) {
			$hasError = true;
			$err_phone = "Phone number must contain at least 11 number";
		} else {
			$phone = htmlspecialchars($_POST["phone"]);
		}
		if (empty($_POST["password"])) 
		{
			$hasError = true;
			$err_password = "Password Required";
		} 
		elseif (strlen($_POST["password"]) <= 7) 
		{
			$hasError = true;
			$err_password = "password must contain at least 8 character";
		} 
		elseif (strpos($_POST["password"], '#') == false && strpos($_POST['password'], '?') == false) 
		{
			$hasError = true;
			$err_password = "Password must contain # character or one ? character";
		} 
		else 
		{
			$upper = 0;
			$lower = 0;
			$number = 0;
			$arr = str_split($_POST["password"]);
			foreach ($arr as $a) 
			{
				if (ctype_upper($a))
					$upper++;
				elseif (ctype_lower($a))
					$lower++;
				elseif (ctype_digit($a))
					$number++;
			}
			if ($upper >= 1 && $lower >= 1 && $number >= 1)
			{
				$password = htmlspecialchars($_POST["password"]);
			} 
			else 
			{
				$err_password = "Password must contain 1 number and combination of uppercase and lowercase alphabet";
			}	
		}
		if (empty($_POST["nid"])) {
        $hasError = true;
        $err_nid = "AIUB ID / National ID number Required";
		} elseif (is_numeric($_POST["nid"]) == false) {
			$hasError = true;
			$err_nid = "AIUB ID / National ID number must contain number";
		} else {
			$nid = htmlspecialchars($_POST["nid"]);
		}

		if (strlen($_POST["nid"]) == 8 || strlen($_POST["nid"]) == 10) {
			$err_nid = "";
		} else {
			$err_nid = "Not a valid id";
			$nid = "";
		}
		if(!$hasError)
		{
			$result = insertHouseOwner($name, $email, $phone, $password, $nid);
			if ($result === true)
			{
				header("Location: allhouse.php");
			}
			$err_db = $result;
		}
	}
	elseif (isset($_POST["changepassword"])) 
	{
		if (empty($_POST['PrevPassword'])) 
		{
			$hasError = true;
			$err_PrevPassword = "Previous Password Required";
		} 
		else 
		{
			$PrevPassword = htmlspecialchars($_POST["PrevPassword"]);
		}
		if (empty($_POST["Password"])) 
		{
			$hasError = true;
			$err_Password = "Password Required";
		} 
		elseif (strlen($_POST["Password"]) <= 7) 
		{
			$hasError = true;
			$err_Password = "Password must contain at least 8 character";
		} 
		elseif (strpos($_POST["Password"], '#') == false && strpos($_POST['Password'], '?') == false) 
		{
			$hasError = true;
			$err_Password = "Password must contain # character or one ? character";
		} 
		else 
		{
			$upper = 0;
			$lower = 0;
			$number = 0;
			$arr = str_split($_POST["Password"]);
			foreach ($arr as $a) 
			{
				if (ctype_upper($a))
					$upper++;
				elseif (ctype_lower($a))
					$lower++;
				elseif (ctype_digit($a))
					$number++;
			}
			if ($upper >= 1 && $lower >= 1 && $number >= 1)
			{
				$Password = htmlspecialchars($_POST["Password"]);
			} 
			else 
			{
				$err_Password = "Password must contain 1 number and combination of uppercase and lowercase alphabet";
			}	
		}
		
		if (empty($_POST["ConfirmPassword"])) {
			$hasError = true;
			$err_ConfirmPassword = "Confirm Password Required";
		} else if ($_POST["Password"] !== $_POST["ConfirmPassword"]) {
			$hasError = true;
			$err_ConfirmPassword = "Password and Confirm Password not match";
		} else {
			$ConfirmPassword = htmlspecialchars($_POST["ConfirmPassword"]);
		}

		if (!$hasError) 
		{
			$operation = changeHouseOwnerPassword($email, $PrevPassword, $Password);

			if (!$operation) 
			{
				$err_success = "Previous password didn't match";
			} 
			else 
			{
				$err_success = "Successfully change password";
			}
		}
	}	
function insertHouseOwner($name, $email, $phone, $password, $nid)
{
    $query = "INSERT INTO house_owners VALUES (NULL, '$name', '$email', '$phone', '$password', '$nid')";

    return execute($query);
}

function getAllHouseOwners()
{
    $query = "SELECT * FROM house_owners";
    $result = get($query);
    return $result;
}

function getHouseOwner($email)
{
    $query = "SELECT * FROM house_owners WHERE email = '$email'";
    $result = get($query);
    if (count($result) === 0)
        return NULL;
    return $result[0];
}
function changeHouseOwnerPassword($email, $prev_pass, $new_pass)
{
    $ho = getHouseOwner($email);
    if ($ho['password'] === $prev_pass) {

        $query = "update house_owners set password = '$new_pass' where email = '$email'";

        return execute($query);
    }
    return false;
}
function getHouseOwnerbyID($id)
{
    $query = "SELECT * FROM house_owners WHERE id = '$id'";
    $result = get($query);
    if (count($result) === 0)
        return NULL;
    return $result[0];
}
function updateHouseOwner($id, $name, $phone, $nid)
{
    $query = "UPDATE house_owners SET name = '$name', phone = '$phone', nid = '$nid' WHERE id = $id";
    return execute($query);
}

function deleteHouseOwner($id)
{
    $query = "DELETE FROM house_owners WHERE id = '$id'";
    return execute($query);
}

function verifyHouseOwner($id)
{
    $query = "UPDATE house_owners SET verify = 1 WHERE id = '$id'";
    return execute($query);
}
?>
<?php
require_once 'model/db_config.php';
$Name = "";
$err_Name = "";
$Email = "";
$err_Email = "";
$Phone = "";
$err_Phone = "";
$Password = "";
$err_Password = "";
$ConfirmPassword = "";
$err_ConfirmPassword = "";
$Address = "";
$err_Address = "";
$type = "";
$err_type = "";
$helpmessage="";
$err_helpmessage="";
$id = "";
$err_id = "";
$urgent="";
$err_urgent="";
$success="";
$err_success="";
$hasError = false;

if (isset($_POST["registratoin"])) {
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
    } else if (strpos($_POST["Email"], "@") == false || strpos($_POST["Email"], ".") == false) {
        $hasError = true;
        $err_Email = "Email must contain @ character and . character";
    } else {
        $Email = htmlspecialchars($_POST["Email"]);
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
        $Phone = htmlspecialchars($_POST["Phone"]);
    }

    if (empty($_POST["Password"])) {
        $hasError = true;
        $err_Password = "Password Required";
    } elseif (strlen($_POST["Password"]) <= 7) {
        $hasError = true;
        $err_Password = "Password must contain at least 8 character";
    } elseif (strpos($_POST["Password"], '#') == false && strpos($_POST['Password'], '?') == false) {
        $hasError = true;
        $err_Password = "Password must contain # character or one ? character";
    } else {
        $upper = 0;
        $lower = 0;
        $number = 0;
        $arr = str_split($_POST["Password"]);
        foreach ($arr as $a) {
            if (ctype_upper($a))
                $upper++;
            elseif (ctype_lower($a))
                $lower++;
            elseif (ctype_digit($a))
                $number++;
        }
        if ($upper >= 1 && $lower >= 1 && $number >= 1) {
            $Password = htmlspecialchars($_POST["Password"]);
        } else {
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

    if (!isset($_POST["type"])) {
        $hasError = true;
        $err_type = "User type Required";
    } else {
        $type = $_POST["type"];
    }

    if (empty($_POST["id"])) {
        $hasError = true;
        $err_id = "AIUB ID / National ID number Required";
    } elseif (is_numeric($_POST["id"]) == false) {
        $hasError = true;
        $err_id = "AIUB ID / National ID number must contain number";
    } else {
        $id = htmlspecialchars($_POST["id"]);
    }

    if (strlen($_POST["id"]) == 8 || strlen($_POST["id"]) == 10) {
        $err_id = "";
    } else {
        $err_id = "Not a valid id";
        $id = "";
    }

    if (!$hasError && $type == "Student") {

        require_once "./controller/StudentController.php";
        $data = false;

        if (getStudent($Email) === NULL) {
            $data = insertStudent($Name, $Email, $Phone, $Password, $id, "NULL");
            header("Location: index.php");
        } else {
            $err_success = "Duplicate email Registration unsuccessful";
        }
    } else if (!$hasError && $type == "FlatOwner") {

        require_once "./controller/HouseOwnerController.php";
        $data = false;

        if (getHouseOwner($Email) === NULL) {
            $data = insertHouseOwner($Name, $Email, $Phone, $Password, $id, "NULL");
            header("Location: index.php");
        } else {
            $err_success = "Duplicate email Registration unsuccessful";
        }
    }
}
elseif (isset($_POST["login"])) {
    if (empty($_POST["Email"])) {
        $hasError = true;
        $err_Email = "Email Required";
    } elseif (strpos($_POST["Email"], "@") == false || strpos($_POST["Email"], ".") == false) {
        $hasError = true;
        $err_Email = "Email must contain @ character and . character";
    } else {
        $Email = $_POST["Email"];
    }

    if (empty($_POST["Password"])) {
        $hasError = true;
        $err_Password = "Password Required";
    } elseif (strlen($_POST["Password"]) <= 7) {
        $hasError = true;
        $err_Password = "Password must contain at least 8 character";
    } elseif (strpos($_POST["Password"], '#') == false) {
        $hasError = true;
        $err_Password = "Password must contain # character or one ? character";
    } else {
        $upper = 0;
        $lower = 0;
        $number = 0;
        $arr = str_split($_POST["Password"]);
        foreach ($arr as $a) {
            if ($a >= 'A' && $a <= 'Z')
                $upper++;
            elseif ($a >= 'a' && $a <= 'z')
                $lower++;
            elseif ($a >= 0)
                $number++;
        }
        if ($upper >= 1 && $lower >= 1 && $number >= 1) {
            $Password = $_POST["Password"];
        } else {
            $err_Password = "Password must contain 1 number and combination of uppercase and lowercase alphabet";
        }
    }

    if (!isset($_POST["type"])) {
        $hasError = true;
        $err_type = "User type Required";
    } else {
        $type = $_POST["type"];
    }

    if (!$hasError && $type == "Admin") {
        require_once "./controller/AdminController.php";
        $loggedinuser = getAdmin($Email);
        // echo '<pre>';
        // var_dump($loggedinuser);
        // echo '</pre>';
        // return;
        if ($loggedinuser != NULL) {
            if ($loggedinuser['verify'] == "0") {
                $err_success = "Your not verify yet. please wait for verification";
            } else {
                $_SESSION['id'] = $loggedinuser['id'];
                $_SESSION['name'] = $loggedinuser['name'];
                $_SESSION['email'] = $loggedinuser['email'];
                $_SESSION['password'] = $loggedinuser['password'];
                $_SESSION['loggedin'] = true;
                $_SESSION['type'] = "Admin";

                header("Location: AdminDashboard.php");
            }
        } else {
            $err_success = "Login credential is not correct";
        }
    } else if (!$hasError && $type == "Student") {
        require_once "./controller/StudentController.php";

        $loggedinuser = getStudent($Email);
        // echo '<pre>';
        // var_dump($loggedinuser);
        // echo '</pre>';
        // return;
        if ($loggedinuser != NULL) {
            if ($loggedinuser['verify'] == "0") {
                $err_success = "Your not verify yet. please wait for verification";
            } else {
                $_SESSION['id'] = $loggedinuser['id'];
                $_SESSION['name'] = $loggedinuser['name'];
                $_SESSION['email'] = $loggedinuser['email'];
                $_SESSION['phone'] = $loggedinuser['phone'];
                $_SESSION['password'] = $loggedinuser['password'];
                $_SESSION['aiub_nid_id'] = $loggedinuser['aiub_nid_id'];
                $_SESSION['h_id'] = $loggedinuser['h_id'];
                $_SESSION['loggedin'] = true;
                $_SESSION['type'] = "Student";

                header("Location: StudentDashboard.php");
            }
        } else {
            $err_success = "Login credential is not correct";
        }
    } else if (!$hasError && $type == "FlatOwner") {
        require_once "./controller/HouseOwnerController.php";

        $loggedinuser = getHouseOwner($Email);
        // echo '<pre>';
        // var_dump($loggedinuser);
        // echo '</pre>';
        // return;
        if ($loggedinuser != NULL) {
            if ($loggedinuser['verify'] == "0") {
                $err_success = "Your not verify yet. please wait for verification";
            } else {
                $_SESSION['id'] = $loggedinuser['id'];
                $_SESSION['name'] = $loggedinuser['name'];
                $_SESSION['email'] = $loggedinuser['email'];
                $_SESSION['phone'] = $loggedinuser['phone'];
                $_SESSION['password'] = $loggedinuser['password'];
                $_SESSION['nid'] = $loggedinuser['nid'];
                $_SESSION['loggedin'] = true;
                $_SESSION['type'] = "FlatOwner";

                header("Location: HouseOwnerDashboard.php");
            }
        } else {
            $err_success = "Login credential is not correct";
        }
    }
}
if (isset($_POST["updateprofile"])) {
    if (empty($_POST["Name"])) {
        $hasError = true;
        $err_Name = "Name Required";
    } elseif (strlen($_POST["Name"]) <= 2) {
        $hasError = true;
        $err_Name = "Name must be greater than 2 characters";
    } else {
        $Name = htmlspecialchars($_POST["Name"]);
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
        $Phone = htmlspecialchars($_POST["Phone"]);
    }

    if (empty($_POST["id"])) {
        $hasError = true;
        $err_id = "AIUB ID / National ID number Required";
    } elseif (is_numeric($_POST["id"]) == false) {
        $hasError = true;
        $err_id = "AIUB ID / National ID number must contain number";
    } else {
        $id = htmlspecialchars($_POST["id"]);
    }

    if (strlen($_POST["id"]) == 8 || strlen($_POST["id"]) == 10) {
        $err_id = "";
    } else {
        $err_id = "Not a valid id";
        $id = "";
    }

    if (!$hasError) {
        require_once "./controller/StudentController.php";
        $data = false;

        $data = updateProfile($_SESSION['id'], $Name, $Phone, $id, "NULL");

        if ($data == false) {
            $err_success = "Duplicate email!! unsuccessful updating profile";
        } else {
            $_SESSION['name'] = $Name;
            $_SESSION['phone'] = $Phone;
            $_SESSION['aiub_nid_id'] = $id;
        }
    }
}
elseif(isset($_POST["helpSubmit"])) {
	if (empty($Name)) {
		$err_Name = "Name Required";
	} else if (strlen($Name) <= 2) {
		$err_Name = "Name must be greater than 2 characters";
	}

	if (empty($Email)) {
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

	if (empty($Address)) {
		$hasError = true;
		$err_Address = "Address Required";
	}
	else{
		$Address = $_POST["Address"];
	}
	
	if (!isset($_POST["type"])) {
		$hasError = true;
		$err_type = "User type Required";
	} 
	else {
		$type = $_POST["type"];
	}

	if (empty($helpmessage)) {
		$hasError = true;
		$err_helpmessage = "Message is Required";
	}
	else {
		$helpmessage = $_POST["helpmessage"];
	}
	if (empty($urgent)) {
		$hasError = true;
		$err_urgent = "Urgent options is Required";
	}
	else {
		$urgent = $_POST["urgent"];
	}
	
}
?>


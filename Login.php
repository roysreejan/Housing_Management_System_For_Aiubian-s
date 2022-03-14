<?php

$Email = "";
$err_Email = "";
$Password = "";
$err_Password = "";
$type = "";
$err_type = "";

$hasError = false;

if (isset($_POST["login"])) {
    if (empty($_POST["Email"])) {
        $hasError = true;
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
	else 
	{
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
        header("Location: AdminHome.php");
    } elseif (!$hasError && $type == "Student") {
        header("Location: StudentHome.php");
    } elseif (!$hasError && $type == "FlatOwner") {
        header("Location: HouseOwner.php");
    }
}
?>

<html>

<head>
    <title>Login</title>
</head>

<body style="width: 40%;">
    <form action="" method="post">
        <!-- <p align="right"><img width="120" height="120" src="Aiub.jpg"></p> -->
        <fieldset>
            <legend>
                <h1>Login</h1>
            </legend>
            <table>
                <tr>
                    <td align="right">Email:</td>
                    <td><input type="text" name="Email" value="<?php echo $Email; ?>"></td>
                    <td><span> <?php echo $err_Email; ?> </span></td>
                </tr>
                </tr>
                <tr>
                    <td align="right">Password:</td>
                    <td><input type="Password" name="Password" value="<?php echo $Password; ?>"></td>
                    <td><span> <?php echo $err_Password; ?> </span></td>

                </tr>
                <td align="right">User type: </td>
                <td>
                    <input type="radio" value="Admin" <?php if ($type == "Admin") echo "checked"; ?> name="type"> Admin<br>
                    <input type="radio" value="Student" <?php if ($type == "Student") echo "checked"; ?> name="type"> Student<br>
                    <input type="radio" value="FlatOwner" <?php if ($type == "FlatOwner") echo "checked"; ?> name="type"> Flat Owner<br>
                </td>
                <td><span> <?php echo $err_type; ?> </span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Login" name="login"> <span><a href="Registration.php"><input type=button value="Registration"></a></span>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>
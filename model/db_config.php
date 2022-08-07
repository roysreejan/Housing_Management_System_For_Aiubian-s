<?php

$db_server = "localhost";
$db_uname = "root";
$db_pass = "";
$db_name = "housing_db";

function execute($query)        //responsible for running insert,update,delete
{
    global $db_server, $db_uname, $db_pass, $db_name;
    $conn = mysqli_connect($db_server, $db_uname, $db_pass, $db_name);
    // $query = mysqli_real_escape_string($conn, $query);
    // var_dump($query);
    // return;
    if ($conn) {
        if (mysqli_query($conn, $query)) {
            return true;
        } else {
            return mysqli_error($conn);
        }
    }
    return false;
}

function get($query){ //responsible for running select queires
		global $db_server,$db_uname,$db_pass,$db_name;
		$conn = mysqli_connect($db_server,$db_uname,$db_pass,$db_name);
		$data = array();
		if($conn){
			$result = mysqli_query($conn,$query);
			while($row = mysqli_fetch_assoc($result)){
				$data[] = $row;
			}
		}
		return $data;
	}
?>
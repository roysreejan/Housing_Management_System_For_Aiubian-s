<?php
	include 'controller/HouseController.php';
	$key = $_GET["key"];
	$houses = searchHouse($key);
	if(count($houses) > 0){
		foreach($houses as $p){
			echo "<a href='edithouse.php?id=".$h["id"]."'>".$h["name"]."</a><br>";
		}
	}
?>
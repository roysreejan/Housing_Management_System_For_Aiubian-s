<?php
	session_start(); 
	include_once "header.php"; 
	require_once 'model/db_config.php';

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'FlatOwner') {
    header("Location: logout.php");
}
	
	$query  = "select * from houses";
	$houses = get($query);
?>

<div class="main">
        <fieldset>
            <legend>
                <h1>House list</h1>
            </legend>
			<input type="text" class="form-control" onkeyup="searchHouse(this)" placeholder="Search...">
			<div id="suggesstion"></div>
            <table class="single-border">
         	<thead>
				<th>Sl#</th>
				<th>House Name</th>
				<th>Address</th>
				<th>Status</th>
				<th>Price</th>
				<th>Edit</th>
				<th>Delete</th>
			
		</thead>
		<tbody>
			<?php
				$i=1;
				foreach($houses as $h){
					echo "<tr>";
						echo "<td>$i</td>";
						echo "<td><img width='80px' height='100px' src='".$h["img"]."'></td>";
						echo "<td>".$h["name"]."</td>";
						echo "<td>".$h["address"]."</td>";
						echo "<td>".$h["status"]."</td>";
						echo "<td>".$h["price"]."</td>";
						echo '<td><a href="edithouse.php?id='.$h["id"].'" class="btn btn-success">Edit</a></td>';
						echo '<td><a class="btn btn-danger">Delete</td>';
					echo "</tr>";
					$i++;
				}
			?>
			
		</tbody>
	</table>
</div>

<!--Products ends -->
<?php include_once "footer.php"; ?>
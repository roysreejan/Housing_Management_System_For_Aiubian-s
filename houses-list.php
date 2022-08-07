<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Admin') {
    header("Location: logout.php");
}

require_once "controller/HouseController.php";

$houses = NULL;
$houses = getAllHouses();

?>
<?php include_once "header.php"; ?>

<div class="main">
    <?php if ($houses !== NULL && !empty($houses)) { ?>
        <fieldset>
            <legend>
                <h1>Student list</h1>
            </legend>
            <table class="single-border">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Apartment ID</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($houses as $house) { ?>
                    <tr>
                        <?php foreach ($house as $key => $value) { ?>
                            <?php
                            if ($key == 'ho_id') {
                                continue;
                            }
                            if ($key == 'status') { ?>
                                <td><?php echo ($value == 1) ? "Booked" : "Not Booked"; ?></td>
                            <?php } else { ?>
                                <td><?php echo $value; ?></td>
                            <?php } ?>
                        <?php } ?>
                        <td>
                            <a href="controller/Delete.php?t=House&id=<?php echo $house['id']; ?>" id="delete-house" class="delete-button" onclick="return confirmDelete();">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>
    <?php } else { ?>
        <center>
            <h1>There are no house</h1>
        </center>
    <?php } ?>

</div>

<?php include_once "footer.php"; ?>
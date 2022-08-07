<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Admin') {
    header("Location: logout.php");
}

require_once "controller/HouseOwnerController.php";

$houseowners = NULL;
$houseowners = getAllHouseOwners();

?>
<?php include_once "header.php"; ?>

<div class="main">
    <?php if ($houseowners !== NULL && !empty($houseowners)) { ?>
        <fieldset>
            <legend>
                <h1>Student list</h1>
            </legend>
            <table class="single-border">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>NID</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($houseowners as $houseowner) { ?>
                    <tr>
                        <?php foreach ($houseowner as $key => $value) { ?>
                            <?php
                            if ($key == 'password' || $key == 'verify') {
                                continue;
                            }
                            ?>
                            <td><?php echo $value; ?></td>
                        <?php } ?>
                        <td>
                            <a href="controller/Delete.php?t=FlatOwner&id=<?php echo $houseowner['id']; ?>" id="delete-houseowner" class="delete-button" onclick="return confirmDelete();">Delete</a>
                            <a href="edit.php?t=FlatOwner&id=<?php echo $houseowner['id']; ?>" id="edit-student" class="verify-button" >Edit</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>
    <?php } else { ?>
        <center>
            <h1>There are no house owner</h1>
        </center>
    <?php } ?>

</div>

<?php include_once "footer.php"; ?>
<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Admin') {
    header("Location: logout.php");
}

require_once "controller/AdminController.php";

$houseowners = NULL;
$houseowners = getUnverifyHouseOwners();

?>
<?php include_once "header.php"; ?>

<div class="main">
    <?php if ($houseowners !== NULL) { ?>
        <fieldset>
            <legend>
                <h1>Unverify House Owner list</h1>
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
                            <button id="verify-houseowner" class="verify-button" onclick="return verifyUser('FlatOwner',<?php echo $houseowner['id']; ?>)">Verify</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>
    <?php } else { ?>
        <center>
            <h1>There are no house owner to verify</h1>
        </center>
    <?php } ?>

</div>

<script src="./js/verify.js"></script>

<?php include_once "footer.php"; ?>
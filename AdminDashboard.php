<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Admin') {
    header("Location: logout.php");
}

require_once "controller/AdminController.php";

$students = NULL;
$students = getUnverifyStudents();

?>
<?php include_once "header.php"; ?>

<div class="main">
    <?php if ($students !== NULL) { ?>
        <fieldset>
            <legend>
                <h1>Unverify Student list</h1>
            </legend>
            <table class="single-border">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>AIUB ID / NID</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($students as $student) { ?>
                    <tr>
                        <?php foreach ($student as $key => $value) { ?>
                            <?php
                            if ($key == 'password' || $key == 'h_id' || $key == 'verify') {
                                continue;
                            }
                            ?>
                            <td><?php echo $value; ?></td>
                        <?php } ?>
                        <td>
                            <button id="verify-student" class="verify-button" onclick="return verifyUser('Student',<?php echo $student['id']; ?>)">Verify</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>
    <?php } else { ?>
        <center>
            <h1>There are no student to verify</h1>
        </center>
    <?php } ?>

</div>

<script src="./js/verify.js"></script>

<?php include_once "footer.php"; ?>
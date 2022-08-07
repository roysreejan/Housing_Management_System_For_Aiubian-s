<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: index.php");
}

if ($_SESSION['type'] != 'Admin') {
    header("Location: logout.php");
}

require_once "controller/StudentController.php";

$students = NULL;
$students = getAllStudents();

?>
<?php include_once "header.php"; ?>

<div class="main">
    <?php if ($students !== NULL && !empty($students)) { ?>
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
                            <a href="controller/Delete.php?t=Student&id=<?php echo $student['id']; ?>" id="delete-student" class="delete-button" onclick="return confirmDelete();">Delete</a>
                            <a href="edit.php?t=Student&id=<?php echo $student['id']; ?>" id="edit-student" class="verify-button" >Edit</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>
    <?php } else { ?>
        <center>
            <h1>There are no student</h1>
        </center>
    <?php } ?>

</div>

<?php include_once "footer.php"; ?>
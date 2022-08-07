<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="navigation">
        <div class="menu">
            <ul>
                <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Admin') { ?>

                    <li><a href="AdminDashboard.php">Verity Student</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="verify-houseowner.php">Verity House Owner</a></li>
                    <li><a href="students-list.php">Student List</a></li>
                    <li><a href="houseowners-list.php">House Owners List</a></li>
                    <li><a href="houses-list.php">Houses List</a></li>
                    <li><a href="add-user.php">Add User</a></li>
					<li><a href="aboutus.php">About Us</a></li>
                    <li><a href="logout.php">Logout</a></li>

                <?php } else if (isset($_SESSION['type']) && $_SESSION['type'] == 'Student') { ?>

                    <li><a href="StudentDashboard.php">Rent House</a></li>
                    <li><a href="update-profile.php">Update Profile</a></li>
                    <li><a href="change-password.php">Change Password</a></li>
                    <li><a href="search-house.php">Search House</a></li>
                    <?php if (isset($_SESSION['h_id']) && $_SESSION['h_id'] !== "NULL") { ?>
                        <li><a href="leave-house.php">Leave House</a></li>
                    <?php } ?>
                    <!-- <li><a href="payment.php">Payment</a></li> -->
                    <!-- <li><a href="help.php">Help</a></li> -->
					<li><a href="aboutus.php">About Us</a></li>
                    <li><a href="logout.php">Logout</a></li>

                <?php } else if (isset($_SESSION['type']) && $_SESSION['type'] == 'FlatOwner') { ?>
				
                    <li><a href="addhouse.php">Add House</a></li>
					<li><a href="allhouse.php">All House</a></li>
					<li><a href="edithouse.php">Edit House</a></li>
					<li><a href="house_change_pass.php">Change Password</a></li>
					<li><a href="update-user-info.php">Update user info</a></li>
					<li><a href="aboutus.php">About Us</a></li>
                    <li><a href="logout.php">Logout</a></li>

                <?php } else { ?>

                    <li><a href="index.php">Login</a></li>
                    <li><a href="registration.php">Registration</a></li>

                <?php } ?>
            </ul>
        </div>
    </div>
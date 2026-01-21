<?php
session_start();
require_once('../Model/userModel.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$users = getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>
    <link rel="stylesheet" href="../Asset/css/admin.css">
</head>
<body>

<header>
    <nav class="header_part">
        <div class="logo-area">
            <img src="../Asset/img/Logo.png" class="logo-img">
            <span class="logo-text">Blood Bridge BD</span>
        </div>

        <div class="dropdown">
            <button class="dropdown-btn">User</button>
            <ul class="dropdown-menu">
                <li><a href="adminProfile.php">My Profile</a></li>
                <li><a href="update_profile.php">Update Profile</a></li>
                <li><a href="../Controller/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
</header>

<section style="display:flex;">
 
    <div class="menu">
        <a href="addDonor.php">Add Donor</a>
        <a href="addVolunteer.php">Add Volunteer</a>
        <a href="addHospital.php">Add Hospital</a>
        <a href="deleteUser.php">Delete User</a>
    </div>

    <div class="content" style="padding:40px; width:100%;">
        <h2 style="text-align:center; font-size:32px; margin-bottom:20px;">
            Delete User
        </h2>

        <?php if (isset($_GET['deleted'])) { ?>
            <p style="color:green; text-align:center;">User deleted successfully</p>
        <?php } ?>

        <table border="1" width="100%" cellpadding="10" style="background:#fff;">
            <tr style="background:#b30000; color:white;">
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Action</th>
            </tr>

            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['phone']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <?php if ($user['user_id'] != $_SESSION['user_id']) { ?>
                            <form action="../Controller/deleteUserController.php" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit" style="background:red;color:white;padding:5px 10px;border:none;">
                                    Delete
                                </button>
                            </form>
                        <?php } else { ?>
                            <em>Current User</em>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</section>

<footer class="footer">
    © 2025 Blood Bridge BD. All rights reserved.
</footer>

</body>
</html>

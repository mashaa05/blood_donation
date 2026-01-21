<?php
session_start();
require_once('../Model/userModel.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html");
    exit;
}

$admin = getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile | Blood Bridge BD</title>
    <link rel="stylesheet" href="../Asset/css/admin.css">
    <style>
        .profile-section {
            margin-left: 250px;
            padding: 50px;
            min-height: calc(100vh - 150px);
            background-color: #fdeaea;
        }

        .profile-section h2 {
            text-align: center;
            font-size: 36px;
            color: #b30000;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .profile-card {
            background-color: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-card label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #b30000;
        }

        .profile-card input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .profile-card button {
            margin-top: 25px;
            padding: 12px 25px;
            background-color: #b30000;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        .profile-card button:hover {
            background-color: #8f0202;
        }
    </style>
</head>
<body>

    <header class="header_part">
        <div class="logo-area">
            <img src="../Asset/img/Logo.png" alt="Blood Bridge BD Logo" class="logo-img">
            <span class="logo-text">Blood Bridge BD</span>
        </div>

        <div class="dropdown">
            <button class="dropdown-btn">User</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="adminProfile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="../View/update_profile.php">Update Profile</a></li>
                <li><a class="dropdown-item" href="../Controller/logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <div class="menu">
        <a href="../View/addDonor.php">Add Donor</a>
        <a href="addVolunteer.html">Add Volunteer</a>
        <a href="addHospital.html">Add Hospital</a>
        <a href="approve.html">Approve Status</a>
        <a href="analytics.html">Analytics</a>
    </div>

    <section class="profile-section">
        <h2>Update Profile</h2>
        <div class="profile-card">
            <form action="../Controller/updateProfileController.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($admin['name']) ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($admin['email']) ?>" required>

                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($admin['phone']) ?>" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter new password" required>

                <label for="role">Role:</label>
                <input type="text" name="role" id="role" value="<?= htmlspecialchars($admin['role']) ?>" readonly>

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </section>
    <footer class="footer">
        <p>© 2025 Blood Bridge BD. All rights reserved.</p>
    </footer>

</body>
</html>

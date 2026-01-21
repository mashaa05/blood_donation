<?php
session_start();
require_once('../Model/userModel.php');


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: Login.html");
    exit;
}


$admin = getUserById($_SESSION['user_id']);

if (!$admin) {
    die("Admin not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile | Blood Bridge BD</title>
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

        .profile-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-card th, .profile-card td {
            text-align: left;
            padding: 15px 10px;
            font-size: 18px;
            color: #2f3542;
        }

        .profile-card th {
            width: 35%;
            color: #b30000;
            font-weight: 600;
        }

        .profile-card tr {
            border-bottom: 1px solid #f0cccc;
        }

        .profile-card tr:last-child {
            border-bottom: none;
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
                <li><a class="dropdown-item" href="#">My Profile</a></li>
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
        <h2>My Profile</h2>
        <div class="profile-card">
            <table>
                <tr>
                    <th>Name</th>
                    <td><?= htmlspecialchars($admin['name']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($admin['email']) ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?= htmlspecialchars($admin['phone']) ?></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>********</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?= htmlspecialchars($admin['role']) ?></td>
                </tr>
            </table>
        </div>
    </section>
    <footer class="footer">
        <p>© 2025 Blood Bridge BD. All rights reserved.</p>
    </footer>

</body>
</html>

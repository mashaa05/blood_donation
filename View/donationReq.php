<?php
session_start();
require_once('../Model/donorModel.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$donor_id = $_SESSION['user_id'];
$donor = getDonor($donor_id);

if (!$donor) {
    die("Donor not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Request</title>
    <link rel="stylesheet" href="../Asset/css/donor.css">
    <style>
       
        .content {
            margin-left: 250px;
            padding: 30px;
            flex: 1;
        }
        .dashboard-card {
            background-color: #fff0f0;
            border: 2px solid #b30000;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(179,0,0,0.2);
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
            font-size: 20px;
            color: #b30000;
        }
    </style>
</head>
<body>

<header>
    <nav class="header_part">
        <div class="logo-area">
            <img src="../Asset/img/Logo.png" class="logo-img">
            <span class="logo-text">Blood Bridge BD</span>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn">Donor</button>
            <ul class="dropdown-menu">
                <li><a href="donor.php">My Profile</a></li>
                <li><a href="../Controller/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
</header>

<section>
  
    <div class="sidebar">
        <div class="menu">
            <a href="donor.php">Availability Status</a>
            <a href="donationReq.php">Donation Request</a>
            
        </div>
    </div>

    <div class="content">
        <div class="dashboard-card">
            <h2>Donation Request</h2>
            <p>No New Request</p>
        </div>
    </div>
</section>


<footer class="footer">
    <p>© 2025 Blood Bridge BD. All rights reserved.</p>
</footer>

</body>
</html>

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

$status = getAvailability($donor_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donor Dashboard</title>
    <link rel="stylesheet" href="../Asset/css/donor.css">
</head>
<body>

<!-- HEADER -->
<header>
    <nav class="header_part">
        <div class="logo-area">
            <img src="../Asset/img/Logo.png" class="logo-img">
            <span class="logo-text">Blood Bridge BD</span>
        </div>

        <div class="dropdown">
            <button class="dropdown-btn">Donor</button>
            <ul class="dropdown-menu">
                <li><a href="#">My Profile</a></li>
                <li><a href="../Controller/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
</header>


<section>
    <div class="sidebar">
        <div class="menu">
            <a href="#" id="availabilityBtn">Availability Status</a>
            
            <a href="donationReq.php">Donation Request</a>
        </div>
    </div>

    <div class="content">
        <div class="dashboard-card" id="dashboardCard" style="display:none;">
            <h2>My Profile</h2>

            <table class="donor_table">
                <tr>
                    <th>Field</th>
                    <th>Information</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?= htmlspecialchars($donor['name']) ?></td>
                </tr>
                <tr>
                    <td>Blood Group</td>
                    <td><?= htmlspecialchars($donor['blood_grp']) ?></td>
                </tr>
                <tr>
                    <td>Availability</td>
                    <td>
                        <input type="checkbox" id="availabilityToggle" <?= $status ? 'checked' : '' ?>>
                        <span id="statusText"><?= $status ? 'Available' : 'Not Available' ?></span>
                    </td>
                </tr>
            </table>
        </div>
     
        <div class="dashboard-card" id="donationReqCard" style="display:none;">
            <h2>Donation Request</h2>
            <p style="text-align:center; font-size:20px; color:#b30000; padding:20px;">
                No New Request
            </p>
        </div>

    </div>
</section>


<footer class="footer">
    <p>© 2025 Blood Bridge BD. All rights reserved.</p>
</footer>

<script>
document.getElementById('availabilityBtn').onclick = e => {
    e.preventDefault();
    document.getElementById('dashboardCard').style.display = 'block';
};

document.getElementById('availabilityToggle').onchange = function () {
    const status = this.checked ? 1 : 0;

    fetch('../Controller/donorAvailabilityController.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `donor_id=<?= $donor_id ?>&status=${status}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('statusText').innerText =
                status ? 'Available' : 'Not Available';
        } else {
            alert('Update failed');
        }
    });
};
</script>

</body>
</html>

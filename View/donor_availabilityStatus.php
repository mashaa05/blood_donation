<?php
session_start();


/*if(!isset($_SESSION['donor_id'])){
    header("Location: login.html"); 
    exit;
}*/

require_once('../model/donorModel.php');
//$donor_id = $_SESSION['donor_id'];


$donor = getdonor($donor_id);
$status = getAvailability($donor_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Asset/css/donor_availibilityStatus.css">
    <title>Donor Availability Status</title>

    <style>
        
        .switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
        }

        .switch input {display:none;}

        .slider {
          position: absolute;
          cursor: pointer;
          top: 0; left: 0; right: 0; bottom: 0;
          background-color: #ccc;
          transition: .4s;
          border-radius: 34px;
        }

        .slider:before {
          position: absolute;
          content: "";
          height: 26px; width: 26px;
          left: 4px; bottom: 4px;
          background-color: white;
          transition: .4s;
          border-radius: 50%;
        }

        input:checked + .slider {background-color: #4CAF50;}
        input:checked + .slider:before {transform: translateX(26px);}
    </style>
</head>
<body>
    <header>
        <nav class="header_part">
            <div class="col-md-2">
                <div class="logo-area">
                    <img src="../Asset/img/Logo.png" alt="Blood Bridge BD Logo" class="logo-img">
                    <span class="logo-text">Blood Bridge BD</span>
                </div>
            </div>
            <div class="col-md-7"></div>
            <div class="col-md-3">
                <div class="dropdown">
                  <button class="dropdown-btn" type="button">User</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">My Profile</a></li>
                    <li><a class="dropdown-item" href="../Controller/update_profile.html">Update Profile</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                  </ul>
                </div>
            </div>      
        </nav>  
    </header>

    <section>
        <div class="col-md-2 sidebar">
            <div class="menu">
                <ul>
                    <li><a href="donor_availibilityStatus.php">Availability Status</a></li>
                    <li><a href="donation_history.php">Donation History</a></li>
                    <li><a href="donation_req.php">Donation Request</a></li>
                </ul>    
            </div>    
        </div>

        <div class="col-md-10 content">
            <h2>Donor Dashboard</h2>
            <table class="donor_table">
                <tr>
                    <th>Field</th>
                    <th>Information</th>
                </tr>
                <tr>
                    <td>Donor Name</td>
                    <td><?php echo $donor['name']; ?></td>
                </tr>
                <tr>
                    <td>Blood Group</td>
                    <td><?php echo $donor['blood_grp']; ?></td>
                </tr>
                <tr>
                    <td>Availability Status</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" id="availabilityToggle" <?php if($status==1) echo 'checked'; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span id="statusText"><?php echo ($status==1) ? "Available" : "Not Available"; ?></span>
                    </td>
                </tr>
            </table>
        </div>    
    </section>

    <footer id="contact" class="footer">
        <h3>Contact Information</h3>
        <p>Email: thebloodbridgebd@gmail.com</p>
        <p>Phone: +8801701987424</p>
        <p>Location: Dhaka, Bangladesh</p>

        <p class="copyright">
            © 2025 Blood Bridge BD. All rights reserved.
        </p>
    </footer>

   
    <script>
        const toggle = document.getElementById('availabilityToggle');
        const statusText = document.getElementById('statusText');

        toggle.addEventListener('change', function() {
            const status = this.checked ? 1 : 0;

            fetch('../controller/donorAvailabilityController.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `donor_id=<?php echo $donor_id; ?>&status=${status}`
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    statusText.textContent = (status === 1) ? "Available" : "Not Available";
                } else {
                    alert("Failed to update status");
                }
            })
            .catch(err => alert("Error: " + err));
        });
    </script>

</body>
</html>

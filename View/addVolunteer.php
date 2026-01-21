<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Volunteer</title>
    <link rel="stylesheet" href="../Asset/css/addDonor.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo-area">
            <img src="../Asset/img/Logo.png" alt="Blood Bridge BD Logo" class="logo-img">
            <span class="logo-text">Blood Bridge BD</span>
        </div>
    </nav>
    <div class="container">

        <header>
            <div class="logo">
                <img src="../Asset/img/Logo.png" alt="Blood Bridge BD Logo">
            </div>
            <h1>Add Volunteer</h1>
        </header>

        <?php if (isset($_GET['success'])) { ?>
            <p style="color: green; text-align: center;">
                Volunteer added successfully!
            </p>
        <?php } ?>

        <div class="addDonor-form">
            <form action="../Controller/volunteerController.php" method="POST">

                <div class="input-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter volunteer name" required>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>

                <div class="input-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="Enter phone number" required>
                </div>

                <div class="input-group">
                    <label>Area</label>
                    <input type="text" name="area" placeholder="Enter working area" required>
                </div>

                <button type="submit" name="addVolunteer" class="save-btn">
                    Save
                </button>

            </form>
        </div>

    </div>

</body>
</html>

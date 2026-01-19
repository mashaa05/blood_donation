<!DOCTYPE html>
<html>
<head>
    <title>Place Blood Order</title>
    <link rel="stylesheet" href="../Asset/css/BloodView.css">
    <link rel="stylesheet" href="../Asset/css/orderBlood.css">
</head>
<body>

<div class="container">

    <h1>Place Blood Order</h1>

    <form method="POST" class="order-form">

        <label>Donor ID</label>
        <input type="text" name="donor_id" value="<?= $donorId; ?>" readonly>

        <label>Blood Group</label>
        <input type="text" name="blood_grp" value="<?= $bloodGrp; ?>" readonly>

        <label>Number of Bags</label>
        <input type="number" name="bags" required min="1">

        <label>Needed Date</label>
        <input type="date" name="need_date" required>
        
        <div class="btn-group">
            <button type="submit">Confirm Order</button>
            <a href="getBlood.php" class="cancel-btn">Cancel</a>
        </div>



    </form>

</div>

</body>
</html>

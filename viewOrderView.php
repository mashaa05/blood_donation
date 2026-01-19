<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="../Asset/css/BloodView.css">
    <link rel="stylesheet" href="../Asset/css/viewOrder.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="nav-left">
        <a href="../Controller/getBlood.php" class="logo">Blood Donation</a>
    </div>

    <div class="nav-right">
        <a href="../Controller/getBlood.php" class="nav-btn">Back</a>
    </div>
</nav>

<div class="container">

    <h1>Blood Orders</h1>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Donor ID</th>
            <th>Blood Group</th>
            <th>Bags</th>
            <th>Need Date</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $orders->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['orderId']; ?></td>
            <td><?= $row['donorId']; ?></td>
            <td><?= $row['bloodGrp']; ?></td>
            <td><?= $row['bags']; ?></td>
            <td><?= $row['needDate']; ?></td>
            <td>
                <a href="../Controller/viewOrder.php?cancel_id=<?= $row['orderId']; ?>"
                   class="cancel-btn"
                   onclick="return confirm('Cancel this order?');">
                   Cancel
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>

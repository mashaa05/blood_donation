<!DOCTYPE html>
<html>
<head>
    <title>Get Blood</title>
    <link rel="stylesheet" href="../Asset/css/BloodView.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="nav-left">
       <a href="../Controller/getBlood.php" class="logo">Blood Donation</a>
    </div>

    <div class="nav-center">
        <form method="GET" class="nav-search">
            <select name="search_type">
                <option value="blood" <?= ($searchType ?? '') == 'blood' ? 'selected' : '' ?>>
                    Blood Group
                </option>
                <option value="location" <?= ($searchType ?? '') == 'location' ? 'selected' : '' ?>>
                    Hospital Location
                </option>
            </select>

            <input type="text"
                   name="search_value"
                   placeholder="Search here..."
                   value="<?= htmlspecialchars($searchValue ?? '') ?>">

            <button type="submit">Search</button>
        </form>
    </div>

    <div class="nav-right">
        <a href="../View/Homepage.html" class="nav-btn">Home</a>
        <a href="viewOrder.php" class="nav-btn">View Orders</a>
    </div>
</nav>

<div class="container">

    <h1>Available Blood Donors</h1>
    <table>
        <tr>
            <th>Donor ID</th>
            <th>Name</th>
            <th>Blood Group</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $donors->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['donor_id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['blood_grp']; ?></td>
            <td>
                <a href="../Controller/placeOrder.php?
                donor_id=<?= $row['donor_id']; ?>&
                blood_grp=<?= $row['blood_grp']; ?>"
                class="order-btn">Place Order</a>

            </td>
        </tr>
        <?php } ?>
    </table>

    <h1>Hospital Information</h1>
    <table>
        <tr>
            <th>Hospital ID</th>
            <th>Hospital Name</th>
            <th>Location</th>
        </tr>

        <?php while ($row = $hospitals->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['hospital_id']; ?></td>
            <td><?= $row['hospital_name']; ?></td>
            <td><?= $row['location']; ?></td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>

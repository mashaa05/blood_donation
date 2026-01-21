<?php
require_once('../model/userModel.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.html");
    exit;
}

$sessionName = $_SESSION['name'];
$role = getRole($sessionName);
//$user = getUser($sessionName);

if (isset($_POST['submit'])) {
    $newName = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $isUpdated = updateUser($sessionName, $email, $phone, $password);

    if ($isUpdated) {
        
        if ($newName !== $sessionName) {
            $_SESSION['name'] = $newName;
        }
        header('Location: message.html');
        exit;
    } else {
        $error = "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Profile</title>
    <link rel="stylesheet" href="../Asset/css/donor.css">
</head>
<body>

<div class="container">
    <h2>Donor Profile</h2>

    <?php if(!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    <form action="" method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required><br>

        <label>Password:</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required><br>

        <button type="submit" name="submit">Update Profile</button>
    </form>
</div>

</body>
</html>

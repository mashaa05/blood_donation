<?php
session_start();
require_once('../Model/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../View/login.html");
    exit;
}

$user_id = $_SESSION['user_id'];

$name     = $_POST['name'] ?? '';
$email    = $_POST['email'] ?? '';
$phone    = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';

$conn = getConnection();

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE user 
            SET name=?, email=?, phone=?, password=? 
            WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",
        $name, $email, $phone, $hashed_password, $user_id
    );
} else {
    $sql = "UPDATE user 
            SET name=?, email=?, phone=? 
            WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "sssi",
        $name, $email, $phone, $user_id
    );
}

mysqli_stmt_execute($stmt);
$_SESSION['name'] = $name;

header("Location: ../View/adminProfile.php?msg=Profile updated successfully");
exit;

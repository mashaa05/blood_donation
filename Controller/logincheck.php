<?php
session_start();
require_once('../model/db.php'); 
require_once('../model/userModel.php');

if(isset($_POST['email']) && isset($_POST['password'])){
    $emailOrPhone = $_POST['email'];
    $password = $_POST['password'];

    $user = checkLogin($emailOrPhone, $password); 

    if($user){
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        
        switch($user['role']){
            case 'admin':
                header("Location: ../view/admin.html");
                exit;
            case 'hospital':
                header("Location: ../view/hospital.php");
                exit;
            case 'volunteer':
                header("Location: ../view/volunteer.php");
                exit;
            case 'patient':
                header("Location: ../view/patient.php");
                exit;
            case 'donor':
                header("Location: ../view/donor.php"); 
                exit;
            default:
                header("Location: ../view/login.html");
                exit;
        }
    } else {
        echo "Invalid email/phone or password";
    }
} else {
    header("Location: ../view/login.html");
    exit;
}
?>

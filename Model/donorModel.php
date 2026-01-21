<?php

require_once('db.php');


if (!function_exists('addDonor')) {
    function addDonor($name, $email, $phone, $blood_grp) {
        $conn = getConnection();
        $sql = "INSERT INTO donor (name, email, phone, blood_grp) 
                VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $blood_grp);
        return mysqli_stmt_execute($stmt);
    }
}


if (!function_exists('getDonor')) {
    function getDonor($donor_id) {
        $conn = getConnection();
        $sql = "SELECT * FROM donor WHERE donor_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $donor_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }
}

if (!function_exists('getAvailability')) {
    
function getAvailability($donor_id){
    $conn = getConnection();
    $sql = "SELECT availability_status FROM donor WHERE donorId=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $donor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row['availability_status'];
    }
    return 0; 
}
}


if (!function_exists('updateAvailability')) {
    function updateAvailability($donor_id, $status) {
        $conn = getConnection();
        $sql = "UPDATE donor SET availability_status=? WHERE donor_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $status, $donor_id);
        return mysqli_stmt_execute($stmt);
    }
}
?>

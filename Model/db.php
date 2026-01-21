<?php

function getConnection() {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'blood_donation');
    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    return $con;
}

/* DONOR FUNCTIONS */

function addDonor($donor_id, $name, $blood_grp) {
    $conn = getConnection();
    $sql = "INSERT INTO donor (donor_id, name, blood_grp) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $donor_id, $name, $blood_grp);
    return mysqli_stmt_execute($stmt);
}

function isDonorExists($donor_id) {
    $conn = getConnection();
    $sql = "SELECT donor_id FROM donor WHERE donor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $donor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return ($result && mysqli_num_rows($result) > 0);
}

function getDonor($donor_id) {
    $conn = getConnection();
    $sql = "SELECT * FROM donor WHERE donor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $donor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function updateDonor($donor_id, $name, $blood_grp) {
    $conn = getConnection();
    $sql = "UPDATE donor SET name = ?, blood_grp = ? WHERE donor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $name, $blood_grp, $donor_id);
    return mysqli_stmt_execute($stmt);
}

function deleteDonor($donor_id) {
    $conn = getConnection();
    $sql = "DELETE FROM donor WHERE donor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $donor_id);
    return mysqli_stmt_execute($stmt);
}

function getAvailability($donor_id) {
    $conn = getConnection();
    $sql = "SELECT availability FROM donor WHERE donor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $donor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row ? $row['availability'] : 0;
}

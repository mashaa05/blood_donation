<?php
require_once('db.php');

function addVolunteer($name, $email, $phone, $area) {
    $conn = getConnection();
    $sql = "INSERT INTO volunteer (name, email, phone, area)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $area);

    return mysqli_stmt_execute($stmt);
}

<?php
require_once('db.php');
function getUserById($user_id) {
    $conn = getConnection();
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function checkLogin($emailOrPhone, $password){
    $conn = getConnection();
    $sql = "SELECT * FROM user WHERE (email=? OR phone=?) AND password=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $emailOrPhone, $emailOrPhone, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result); // returns user array or null
}

function addUser($name, $email, $phone, $password, $role): bool {
    $conn = getConnection();
    $sql = "INSERT INTO user (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $password, $role);
    return mysqli_stmt_execute($stmt);
}

function editUser($current_name, $name, $email, $phone) {
    $conn = getConnection(); 
    $sql = "UPDATE user SET name=?, email=?, phone=? WHERE name=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $current_name);
    return mysqli_stmt_execute($stmt);
}

function updateUserProfile($user_id, $name, $email, $phone, $password) {
    $conn = getConnection();
    $sql = "UPDATE user SET name=?, email=?, phone=?, password=? WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $password, $user_id);
    return mysqli_stmt_execute($stmt);
}

function updateUser($oldName, $name, $email, $phone) {
    $conn = getConnection();
    $sql = "UPDATE user 
            SET name = ?, email = ?, phone = ?
            WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $oldName);
    
    return mysqli_stmt_execute($stmt);
}


function deleteUser($name) {
    $conn = getConnection();
    $sql = "DELETE FROM user WHERE name=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    return mysqli_stmt_execute($stmt);
}

function checkUserExists($email, $name){
    $conn = getConnection();
    $sql = "SELECT * FROM user WHERE email=? OR name=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) >= 1;
}

function checkIfUsernameExists($name) {
    $conn = getConnection(); 
    $sql = "SELECT * FROM user WHERE name=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) > 0;
}

function checkEmailExists($email) {
    $conn = getConnection();
    $sql = "SELECT * FROM user WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) >= 1;
}

function getRole($name) {
    $conn = getConnection();
    $sql = "SELECT role FROM user WHERE name=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row['role'];
    }
    return null;
}

function getApprovalStatus($name) {
    $conn = getConnection();
    $sql = "SELECT is_approved FROM user WHERE name=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row['is_approved'] == 1;
    }
    return false;
}

function getAllUsers() {
    $conn = getConnection();
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    $users = [];
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }
    }
    return $users;
}

function getApprovedUserFilter($role_filter=null, $name_filter=null) {
    $conn = getConnection();
    $sql = "SELECT * FROM user WHERE is_approved=1";
    if($role_filter) $sql .= " AND role='$role_filter'";
    if($name_filter) $sql .= " AND name LIKE '%$name_filter%'";
    $result = mysqli_query($conn, $sql);
    $users = [];
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }
    }
    return $users;
}

function getTotalUsers() {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as total FROM user";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function getTotalAdmins() {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as total FROM user WHERE role='admin'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function getTotalDonors() {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as total FROM user WHERE role='donor'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function getTotalVolunteers() {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as total FROM user WHERE role='volunteer'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function recoverPassword($email, $new_password) {
    $conn = getConnection();
    $sql = "UPDATE user SET password=? WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $new_password, $email);
    return mysqli_stmt_execute($stmt);
}

?>

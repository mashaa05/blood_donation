<?php
require_once('../model/donorModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $donor_id = $_GET['donor_id'];
    $status = getAvailability($donor_id);
    echo json_encode(['status' => $status]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    parse_str(file_get_contents("php://input"), $post_vars);
    $donor_id = $post_vars['donor_id'];
    $status   = $post_vars['status'];

    $success = updateAvailability($donor_id, $status);

    echo json_encode(['success' => $success ? true : false]);
}
?>


<?php
require_once '../Model/OrderModel.php';

$orderModel = new OrderModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $donorId   = $_POST['donor_id'];
    $bloodGrp  = $_POST['blood_grp'];
    $bags      = $_POST['bags'];
    $needDate  = $_POST['need_date'];

    $orderModel->insertOrder($donorId, $bloodGrp, $bags, $needDate);
   
    header("Location: getBlood.php");
    exit;
}

// GET request (from Place Order click)
$donorId  = $_GET['donor_id'];
$bloodGrp = $_GET['blood_grp'];

include '../View/placeOrderView.php';

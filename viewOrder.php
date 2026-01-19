<?php
require_once '../Model/OrderModel.php';

$orderModel = new OrderModel();

/* Cancel Order */
if (isset($_GET['cancel_id'])) {
    $orderModel->cancelOrder($_GET['cancel_id']);
    header("Location: viewOrder.php");
    exit;
}

/* View Orders */
$orders = $orderModel->getAllOrders();

include '../View/viewOrderView.php';

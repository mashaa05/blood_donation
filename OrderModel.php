<?php
require_once 'dbConn.php';

class OrderModel {

    public function insertOrder($donorId, $bloodGrp, $bags, $needDate) {
        global $conn;
        $sql = "INSERT INTO blood_order (donorId, bloodGrp, bags, needDate)
                VALUES ('$donorId', '$bloodGrp', '$bags', '$needDate')";
        return $conn->query($sql);
    }

    public function getAllOrders() {
        global $conn;
        $sql = "SELECT * FROM blood_order ORDER BY orderId DESC";
        return $conn->query($sql);
    }

    public function cancelOrder($orderId) {
        global $conn;
        $sql = "DELETE FROM blood_order WHERE orderId='$orderId'";
        return $conn->query($sql);
    }
}
?>

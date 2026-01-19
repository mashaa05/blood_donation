<?php
require_once 'dbConn.php';

class HospitalModel {

    public function searchHospitals($location) {
        global $conn;

        if (!empty($location)) {
            $sql = "SELECT * FROM hospital WHERE location LIKE '%$location%'";
        } else {
            $sql = "SELECT * FROM hospital";
        }

        return $conn->query($sql);
    }
}
?>

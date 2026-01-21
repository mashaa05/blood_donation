<?php
require_once 'dbConn.php';

class DonorModel {

    public function searchDonors($bloodGrp) {
        global $conn;

        if (!empty($bloodGrp)) {
            $sql = "SELECT * FROM donor WHERE blood_grp LIKE '%$bloodGrp%'";
        } else {
            $sql = "SELECT * FROM donor";
        }

        return $conn->query($sql);
    }
}

?>

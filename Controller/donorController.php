<?php
require_once('../model/donorModel.php');

if (isset($_POST['addDonor'])) {

    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $blood_grp  = $_POST['blood_grp'];

    $result = addDonor($name, $email, $phone, $blood_grp);

    if ($result) {
        header("Location: ../view/addDonor.php?success=1");
    } else {
        echo "Failed to add donor";
    }
}

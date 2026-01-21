<?php
require_once('../Model/volunteerModel.php');

if (isset($_POST['addVolunteer'])) {

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $area  = $_POST['area'];

    $result = addVolunteer($name, $email, $phone, $area);

    if ($result) {
        header("Location: ../View/addVolunteer.php?success=1");
        exit;
    } else {
        echo "Failed to add volunteer";
    }
}

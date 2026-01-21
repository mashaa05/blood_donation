<?php
require_once '../Model/DonorModel.php';
require_once '../Model/HospitalModel.php';

$searchType  = $_GET['search_type'] ?? '';
$searchValue = $_GET['search_value'] ?? '';

$donorModel = new DonorModel();
$hospitalModel = new HospitalModel();

if ($searchType == 'blood') {
    $donors = $donorModel->searchDonors($searchValue);
    $hospitals = $hospitalModel->searchHospitals('');
}
elseif ($searchType == 'location') {
    $donors = $donorModel->searchDonors('');
    $hospitals = $hospitalModel->searchHospitals($searchValue);
}
else {
    $donors = $donorModel->searchDonors('');
    $hospitals = $hospitalModel->searchHospitals('');
}

include '../View/getBloodView.php';
?>
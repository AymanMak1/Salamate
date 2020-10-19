<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Vaccine.php';

// Instatiate DB & connect

$database = new Database();
$db = $database->connect();

// Instatiate user object
$vaccine = new Vaccine($db);

// GET THE ID
$vaccine->idvaccine = isset($_GET['idvaccine']) ? $_GET['idvaccine'] : die();

//GET POST
$vaccine->read_single();

// Create array
$user_arr = array(
    "idvaccine" => $vaccine->idvaccine,
    "vaccineName" => $vaccine->vaccineName,
    "iddisease" => $vaccine->iddisease,
    "diseaseName" => $vaccine->diseaseName,
    "vaccineInfos" => $vaccine->vaccineInfos,
    "nbrDoses" => $vaccine->nbrDoses,
    "daysBetween" => $vaccine->daysBetween,
    "addedAt" => $vaccine->addedAt,
);

// Make JSON
echo (json_encode($user_arr));  
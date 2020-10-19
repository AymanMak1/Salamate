<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Maladie.php';

// Instatiate DB & connect

$database = new Database();
$db = $database->connect();

// Instatiate user object
$maladie = new Maladie($db);

// GET THE ID
$maladie->iddisease = isset($_GET['iddisease']) ? $_GET['iddisease'] : die();

//GET POST
$maladie->read_single();

// Create array
// Create array
$maladie_arr = array(
    "iddisease" => $maladie->iddisease,
    "diseaseName" => $maladie->diseaseName,
    "countryNameFr" => $maladie->countryNameFr,
    "idcountry" => $maladie->idcountry,
    "addedAt" => $maladie->addedAt,
);

// Make JSON
echo (json_encode($maladie_arr));  
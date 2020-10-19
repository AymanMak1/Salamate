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
$maladie->diseaseName = isset($_GET['diseaseName']) ? $_GET['diseaseName'] : die();

//GET POST
$maladie->read_single_byDiseaseName();

// Create array
$maladie_arr = array(
    "iddisease" => $maladie->iddisease,
    "username" => $maladie->diseaseName,
    "fullName" => $maladie->addedAt,
);

// Make JSON
echo (json_encode($maladie_arr));  
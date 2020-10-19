<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../SalamateDashboard/config/Database.php';
include_once '../../models/Voyage.php';

// instantiate the DB & CONNECT

$database = new Database();
$db = $database->connect();

// create a user object

$voyage= new Voyage($db);

// GET THE ID
$voyage->idtrip = isset($_GET['idtrip']) ? $_GET['idtrip'] : die();
//$voyage->iduser = isset($_GET['iduser']) ? $_GET['iduser'] : die();

//GET POST
$voyage->read_single();

// Create array
$voyage_arr = array(
    "idtrip" => $voyage->idtrip,
    "iduser" => $voyage->iduser,
    "tripName" => $voyage->tripName,
    "tripDeparture" => $voyage->tripDeparture,
    "tripDestination" => $voyage->tripDestination,
    "tripStartDate" => $voyage->tripStartDate,
    "tripEndDate" => $voyage->tripEndDate,
);

// Make JSON
echo (json_encode($voyage_arr));  
<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Vaccine.php';

// Instatiate DB & connect

$database = new Database();
$db = $database->connect();

// Instatiate blog post object
$vaccine = new vaccine($db);

//GET POST
$result = $vaccine->count();
$count = $result->fetchColumn(); 
echo json_encode($count);

// Make JSON

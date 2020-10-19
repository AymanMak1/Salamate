<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Maladie.php';

// Instatiate DB & connect

$database = new Database();
$db = $database->connect();

// Instatiate blog post object
$maladie = new Maladie($db);

//GET POST
$result = $maladie->count();
$count = $result->fetchColumn(); 
echo json_encode($count);

// Make JSON

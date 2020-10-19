<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Actualite.php';

// Instatiate DB & connect

$database = new Database();
$db = $database->connect();

// Instatiate blog post object
$actualite = new Actualite($db);

//GET POST
$result = $actualite->count();
$count = $result->fetchColumn(); 
echo json_encode($count);

// Make JSON

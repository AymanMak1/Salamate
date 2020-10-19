<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instatiate DB & connect

$database = new Database();
$db = $database->connect();

// Instatiate blog post object
$user = new User($db);

//GET POST

$result = $user->countUnverifiedUsers();
$count = $result->fetchColumn(); 

// Make JSON
echo json_encode($count);


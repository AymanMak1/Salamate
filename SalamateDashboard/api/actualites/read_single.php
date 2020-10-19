<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Actualite.php';

// Instatiate DB & connect

$database = new Database();
$db = $database->connect();

// Instatiate user object
$actualite = new Actualite($db);

// GET THE ID
$actualite->idavis = isset($_GET['idavis']) ? $_GET['idavis'] : die();

//GET POST
$actualite->read_single();

// Create array
$actualite_arr = array(
    "idavis" => $actualite->idavis,
    "title" =>  $actualite->title,
    "publicationDate" => $actualite->publicationDate,
    "description" =>  $actualite->description,
    "published" =>  $actualite->published,
);

// Make JSON
echo (json_encode($actualite_arr));  
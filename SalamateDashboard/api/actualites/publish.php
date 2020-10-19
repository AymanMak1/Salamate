<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Actualite.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$actualite = new Actualite($db);

// GET THE ID OF THE USER
$actualiteToPublish = $_REQUEST['idavis'];

// SET ID to update
$actualite->idavis= $actualiteToPublish;
$actualite->published= 1;

// delete post
if($actualite->publish()){
    echo json_encode(
        array('message' => 'Travel Notice published')
    );
}else{
    echo json_encode(
        array('message' => 'Travel Notice is not published')
    );
}
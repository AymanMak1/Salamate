<?php


// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Actualite.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$actualite = new Actualite($db);

// GET THE RAW POSTED DATA
//$data = json_decode(file_get_contents("php://input"));

$actualite->title=utf8_encode($_REQUEST['title']);
$actualite->publicationDate=$_REQUEST['publicationDate'];
$actualite->description=utf8_encode($_REQUEST['description']);
$actualite->published=$_REQUEST['published'];

// Create post
if($actualite->create()){
    echo json_encode(
        array('message' => 'Actualite Created')
    );
}else{
    echo json_encode(
        array('message' => 'Actualite not Created')
    );
}
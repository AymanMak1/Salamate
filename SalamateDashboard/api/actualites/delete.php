<?php
// Headers

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Actualite.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$actualite = new Actualite($db);

// GET THE ID OF THE USER
$actualiteToDelete = $_REQUEST['idavis'];

//$data = json_decode(file_get_contents("php://input"));

// SET ID to update
$actualite->idavis= $actualiteToDelete;

// delete post
if($actualite->delete()){
    echo json_encode(
        array('message' => 'Actulaite deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Actualite not deleted')
    );
}
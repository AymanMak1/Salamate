<?php
// Headers

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Maladie.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$maladie = new Maladie($db);

// GET THE ID OF THE Disease

$maladieToDelete = $_REQUEST['iddisease'];

//$data = json_decode(file_get_contents("php://input"));

// SET ID to delete

$maladie->iddisease= $maladieToDelete;


// delete disease
if($maladie->delete()){
    echo json_encode(
        array('message' => 'Disease deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Disease not deleted')
    );
}
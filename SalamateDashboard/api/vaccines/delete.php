<?php
// Headers

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Vaccine.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$vaccine = new Vaccine($db);

// GET THE ID OF THE Disease

$vaccineToDelete = $_REQUEST['idvaccine'];

//$data = json_decode(file_get_contents("php://input"));

// SET ID to delete

$vaccine->idvaccine= $vaccineToDelete;


// delete disease
if($vaccine->delete()){
    echo json_encode(
        array('message' => 'Vaccine deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Vaccine not deleted')
    );
}
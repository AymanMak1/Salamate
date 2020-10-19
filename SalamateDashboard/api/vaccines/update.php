<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Vaccine.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $vaccine = new Vaccine($db);
  
  // Get raw posted data
 // $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $vaccine->vaccineName=utf8_encode($_REQUEST['vaccineName']);
  $vaccine->iddisease=$_REQUEST['iddisease'];
  $vaccine->vaccineInfos=utf8_encode($_REQUEST['vaccineInfos']);
  $vaccine->nbrDoses=$_REQUEST['nbrDoses'];
  $vaccine->daysBetween = $_REQUEST['daysBetween'];
  $vaccine->idvaccine = $_REQUEST['idvaccine'];

  // Update post
  if($vaccine->update()) {
    echo json_encode(
      array('message' => 'Vaccine Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Vaccine Not Updated')
    );
  }

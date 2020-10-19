<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../SalamateDashboard/config/Database.php';
  include_once '../../models/Vaccine.php';

  session_start();
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $vaccine = new Vaccine($db);

  // GET DATA
  $vaccine->status = 1;
  $vaccine->idvaccine = $_REQUEST['idvaccine'];
  $vaccine->iduser = $_SESSION['iduser'];

  // Update post
  if($vaccine->completedVaccine()) {
    echo json_encode(
      array('message' => 'Vaccination has been completed ')
    );
  } else {
    echo json_encode(
      array('message' => 'Vaccination has not been completed')
    );
  }

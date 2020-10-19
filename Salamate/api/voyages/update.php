<?php 
  // Headers
  session_start();
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../SalamateDashboard/config/Database.php';
  include_once '../../models/Voyage.php';

    $database = new Database();
    $db = $database->connect();

    // create a trip object

    $voyage= new Voyage($db);

    // GET THE RAW POSTED DATA

    $voyage->tripName=$_POST['tripName'];
    $voyage->tripDeparture=utf8_encode($_POST['tripDeparture']);
    $voyage->tripDestination=utf8_encode($_POST['tripDestination']);
    $voyage->tripStartDate=$_POST['tripStartDate'];
    $voyage->tripEndDate=$_POST['tripEndDate'];
    $voyage->idtrip=$_POST['idtrip'];

    // Create a trip
    if($voyage->update()){
        echo json_encode(
            array('message' => 'trip Modified')
        );
    }else{
        echo json_encode(
            array('message' => 'trip not Modified')
        );
    }
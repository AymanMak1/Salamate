<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../SalamateDashboard/config/Database.php';
include_once '../../models/Voyage.php';

// instantiate the DB & CONNECT

$database = new Database();
$db = $database->connect();

// create a trip object

$voyage= new Voyage($db);


// User post query
$voyage->iduser = isset($_GET['iduser']) ? $_GET['iduser'] : die();
$result = $voyage->read();

// Get row Count

$count= $result->rowCount();


if($count > 0){
  // Users array
  $voyages_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);  
      $voyage_item = array(
            'idtrip' => $idtrip,
            'iduser' => $iduser,
            'tripName' => utf8_encode($tripName),
            'tripDeparture' => utf8_encode($tripDeparture),
            'tripDestination' => utf8_encode($tripDestination),
            'tripStartDate' => utf8_encode($tripStartDate),
            'tripEndDate' => utf8_encode($tripEndDate),
      );
     
    // Push to "data"
    array_push($voyages_arr,$voyage_item);

  }
    echo json_encode($voyages_arr,JSON_UNESCAPED_UNICODE);
    //echo http_response_code();

}else{
    // No User
    echo json_encode(array('Message'=> 'No trips Found'));
}

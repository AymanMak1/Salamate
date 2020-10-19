<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Maladie.php';

// instantiate the DB & CONNECT

$database = new Database();
$db = $database->connect();

// create a user object

$maladie = new Maladie($db);

// User post query

$result = $maladie->read();

// Get row Count

$count= $result->rowCount();


if($count > 0){
  // Users array
  $maladies_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);  
      $maladie_item = array(
            'iddisease' => $iddisease,
            'abrCountry' => utf8_encode($abrCountry),
            'countryNameFr' => utf8_encode($countryNameFr),
            'diseaseName' => utf8_encode($diseaseName),
            'addedAt' => utf8_encode($addedAt),
      );
     
    // Push to "data"
    array_push($maladies_arr,$maladie_item);

  }
    echo json_encode($maladies_arr,JSON_UNESCAPED_UNICODE);
    //echo http_response_code();



}else{
    // No User
    echo json_encode(array('Message'=> 'No Disease Founds'));
}

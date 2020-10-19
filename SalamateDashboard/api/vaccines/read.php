<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Vaccine.php';

// instantiate the DB & CONNECT

$database = new Database();
$db = $database->connect();

// create a user object

$vaccine = new Vaccine($db);

// User post query

$result = $vaccine->read();

// Get row Count

$count= $result->rowCount();


if($count > 0){
  // Users array
  $vaccines_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);  
      $vaccine_item = array(
            'idvaccine' => $idvaccine,
            'diseaseName' => utf8_encode($diseaseName),
            'vaccineName' => utf8_encode($vaccineName),
            'vaccineInfos' => utf8_encode($vaccineInfos),
            'nbrDoses' => $nbrDoses,
            'daysBetween' => $daysBetween,
            'addedAt' => $addedAt,
      );
     
    // Push to "data"
    array_push($vaccines_arr,$vaccine_item);

  }
    echo json_encode($vaccines_arr,JSON_UNESCAPED_UNICODE);
    //echo http_response_code();

}else{
    // No User
    echo json_encode(array('Message'=> 'No Vaccines Founds'));
}

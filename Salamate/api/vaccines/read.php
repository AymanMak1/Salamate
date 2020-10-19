<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../SalamateDashboard/config/Database.php';
include_once '../../models/Vaccine.php';

// instantiate the DB & CONNECT

$database = new Database();
$db = $database->connect();

// create a trip object

$vaccine= new Vaccine($db);


// User post query
$vaccine->iduser = isset($_GET['iduser']) ? $_GET['iduser'] : die();
$vaccine->idtrip = isset($_GET['idtrip']) ? $_GET['idtrip'] : die();

$result = $vaccine->read();

// Get row Count

$count= $result->rowCount();


if($count > 0){
  // Users array
  $vaccines_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);  
    // diseaseName,vaccineName,vaccineInfos,nbrDoses,daysBetween
      $vaccine_item = array(
            'idvaccine' => $idvaccine,
            'diseaseName' => $diseaseName,
            'vaccineName' => $vaccineName,
            'tripDestination' => utf8_encode($tripDestination),
            'vaccineInfos' => utf8_encode($vaccineInfos),
            'nbrDoses' => $nbrDoses,
            'daysBetween' => $daysBetween,
            'firstDoseDate' => $firstDoseDate,
            'status' => $status
      );
     
    // Push to "data"
    array_push($vaccines_arr,$vaccine_item);

  }
    echo json_encode($vaccines_arr,JSON_UNESCAPED_UNICODE);
    //echo http_response_code();

}else{
    // No User
    echo json_encode(array('Message'=> 'No Vaccines Found'));
}

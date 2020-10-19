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

$result = $vaccine->notifyMe();

// Get row Count

$count= $result->rowCount();


if($count > 0){
  // Users array
  $vaccines_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);  
    // diseaseName,vaccineName,vaccineInfos,nbrDoses,daysBetween
      $vaccine_item = array(
            'vaccineName' => $vaccineName,
      );
     
    // Push to "data"
    array_push($vaccines_arr,$vaccine_item);

  }
    echo json_encode($vaccines_arr,JSON_UNESCAPED_UNICODE);
    //echo http_response_code();

}else{
    // No User
    echo json_encode(array('Message'=> 'No Vaccines to complete Found'));
}

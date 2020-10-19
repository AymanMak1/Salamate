<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Actualite.php';

// instantiate the DB & CONNECT

$database = new Database();
$db = $database->connect();

// create a user object

$actualite = new Actualite($db);

// User post query

$result = $actualite->read();

// Get row Count

$count= $result->rowCount();


if($count > 0){
  // Users array
  $actualites_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);  
      $actualite_item = array(
            'idavis' => $idavis,
            'title' => utf8_encode($title),
            'publicationDate' => $publicationDate,
            'description' => htmlspecialchars(strip_tags(utf8_encode($description))), 
            'published' => $published
      );
     
    // Push to "data"
    array_push($actualites_arr,$actualite_item);

  }
    
    echo json_encode($actualites_arr,JSON_UNESCAPED_UNICODE);
    //echo http_response_code();



}else{
    // No User
    echo json_encode(array('Message'=> 'No User Founds'));
}

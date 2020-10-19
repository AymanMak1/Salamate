<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// instantiate the DB & CONNECT

$database = new Database();
$db = $database->connect();

// create a user object

$user = new User($db);

// User post query

$result = $user->read();

// Get row Count

$count= $result->rowCount();


if($count > 0){
  // Users array
  $users_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);  
      $user_item = array(
            'iduser' => $iduser,
            'username' => utf8_encode($username),
            'fullName' => utf8_encode($fullName),
            'nationality' => utf8_encode($nationality),
            'phoneNumber' => utf8_encode($phoneNumber),
            'birthday' => utf8_encode($birthday),
            'gmail' => utf8_encode($gmail),
            'profilPic' => utf8_encode($profilPic),
            'password' => utf8_encode($password),
            'vkey' => utf8_encode($vkey),
            'verified' => utf8_encode($verified),
            'role' => utf8_encode($role),
            'createdAt' => utf8_encode($createdAt)
      );
     
    // Push to "data"
    array_push($users_arr,$user_item);

  }
    echo json_encode($users_arr,JSON_UNESCAPED_UNICODE);
    //echo http_response_code();



}else{
    // No User
    echo json_encode(array('Message'=> 'No User Founds'));
}

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

$result = $user->latestUsers();

// Get row Count

$count= $result->rowCount();

if($count > 0){
  // Users array
  $users_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);  
      $user_item = array(
          'username' => $username,
          'fullName' => $fullName,
          'gmail' => $gmail,
          'role' => $role,
          'verified' => $verified,
          'createdAt' => $createdAt
      );
    // Push to "data"
    array_push($users_arr,$user_item);
  }
  echo  json_encode($users_arr);

}else{
    // No User
    echo json_encode(array('Message'=> 'No User Founds'));
}

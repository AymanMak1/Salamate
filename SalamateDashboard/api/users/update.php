<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $user = new User($db);
  
  // Get raw posted data
 // $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $user->username=utf8_encode($_REQUEST['username']);
  $user->fullName=utf8_encode($_REQUEST['fullName']);
  $user->nationality=utf8_encode($_REQUEST['nationality']);
  $user->phoneNumber=utf8_encode($_REQUEST['phoneNumber']);
  $user->birthday=utf8_encode($_REQUEST['birthday']);
  $user->gmail=utf8_encode($_REQUEST['gmail']);
  $user->profilPic= $user->username . "Pdp" . rand();
  $user->password=hash("sha512",$_REQUEST['password']);
  $user->role=$_REQUEST['role'];

// Update
if($user->update()){
    echo json_encode(
        array('message' => 'User Updated')
    );
}else{
    echo json_encode(
        array('message' => 'User Nit Updated')
    );
}


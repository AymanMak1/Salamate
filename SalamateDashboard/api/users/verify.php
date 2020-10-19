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

// GET THE ID OF THE USER
$userToVerify = $_REQUEST['iduser'];

// SET ID to update
$user->iduser= $userToVerify;
$user->verified= 1;

// delete post
if($user->verify()){
    echo json_encode(
        array('message' => 'User verified')
    );
}else{
    echo json_encode(
        array('message' => 'User verified')
    );
}
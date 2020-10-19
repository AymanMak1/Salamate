<?php


// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$user = new User($db);

// GET THE RAW POSTED DATA
//$data = json_decode(file_get_contents("php://input"));

//var_dump($_FILES);
$user->username=utf8_encode($_REQUEST['username']);
$user->fullName=utf8_encode($_REQUEST['fullName']);
$user->nationality=utf8_encode($_REQUEST['nationality']);
$user->phoneNumber=utf8_encode($_REQUEST['phoneNumber']);
$user->birthday=utf8_encode($_REQUEST['birthday']);
$user->gmail=utf8_encode($_REQUEST['gmail']);
$user->profilPic= $user->username . "Pdp" . rand();

/*
if(isset($_FILES['profilPic']) && !empty($_FILES['profilPic']['name']) && is_uploaded_file($_FILES['profilPic']['tmp_name'])){
    $images=$_FILES['pdp']['name'];
    $tmp_dir=$_FILES['pdp']['tmp_name'];
    $imageSize=$_FILES['pdp']['size'];
    $upload_dir='../../../pdp/';
    $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
    $profilPic=$this->username."Pdp".rand().".".$imgExt;
    $result=move_uploaded_file($tmp_dir, $upload_dir.$pdp);
    $user->profilPic = $profilPic;
}else{
    echo json_encode(
        array('Image' => 'Image Error')
    );
}
*/
    
$user->password=hash("sha512",$_REQUEST['password']);
$user->vkey=hash("sha512",time()+rand());
$user->verified=0;
$user->role=$_REQUEST['role'];

// Create post
if($user->create()){
    echo json_encode(
        array('message' => 'User Created')
    );
}else{
    echo json_encode(
        array('message' => 'User not Created')
    );
}
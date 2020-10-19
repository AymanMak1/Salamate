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
  session_start();

  $stmtConn = $user->getConn();
  // Get raw posted data
  if(isset($_REQUEST['iduser'])){
    $user->iduser=utf8_encode($_REQUEST['iduser']);
  }else{
    $user->iduser = $_SESSION['iduser'];
  }

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
if(isset($_REQUEST['role'])){
  $user->role = utf8_encode($_REQUEST['role']);
}else{
  $user->role = $_SESSION['role'];
}

//var_dump($_REQUEST);
//var_dump($_POST);


if($_REQUEST['password'] == '' && $_REQUEST['profilPic'] == '' ){
    $query = "UPDATE _utilisateur SET 
    username=:username, fullName=:fullName, nationality=:nationality, phoneNumber=:phoneNumber, birthday=:birthday,gmail=:gmail, role=:role
    WHERE iduser=:iduser";
    $stmt = $stmtConn->prepare($query);
    $stmt->bindParam(":username",$user->username);
    $stmt->bindParam(":fullName",$user->fullName);
    $stmt->bindParam(":nationality",$user->nationality);
    $stmt->bindParam(":phoneNumber",$user->phoneNumber);
    $stmt->bindParam(":birthday",$user->birthday);
    $stmt->bindParam(":gmail",$user->gmail);
    $stmt->bindParam(":role",$user->role);
    $stmt->bindParam(":iduser",$user->iduser);
    if($stmt->execute()) {
        // Update post
        echo json_encode(
               array('message' => 'Account Updated')
        );
     
        return true;
       }   
       // Print error if something goes wrong
       printf("Error: %s.\n", $stmt->error);
       echo json_encode(
           array('message' => 'Account Not Updated')
         );
     
       return false;
    
}else if($_REQUEST['password'] == '' && $_REQUEST['profilPic'] != ''){
    $query = "UPDATE _utilisateur SET 
    username=:username, fullName=:fullName, nationality=:nationality, phoneNumber=:phoneNumber, birthday=:birthday,gmail=:gmail,profilPic=:profilPic,role=:role
    WHERE iduser=:iduser";
    $stmt = $stmtConn->prepare($query);
    $stmt->bindParam(":username",$user->username);
    $stmt->bindParam(":fullName",$user->fullName);
    $stmt->bindParam(":nationality",$user->nationality);
    $stmt->bindParam(":phoneNumber",$user->phoneNumber);
    $stmt->bindParam(":birthday",$user->birthday);
    $stmt->bindParam(":gmail",$user->gmail);
    $stmt->bindParam(":profilPic",$user->profilPic);
    $stmt->bindParam(":role",$user->role);
    $stmt->bindParam(":iduser",$user->iduser);
    if($stmt->execute()) {
        // Update post
   
           echo json_encode(
               array('message' => 'Account Updated')
           );
     
           return true;
       }   
       // Print error if something goes wrong
       printf("Error: %s.\n", $stmt->error);
       echo json_encode(
           array('message' => 'Account Not Updated')
         );
     
       return false;
   
}else if($_REQUEST['password'] != '' && $_REQUEST['profilPic'] == '' ){
    $query = "UPDATE _utilisateur SET 
    username=:username, fullName=:fullName, nationality=:nationality, phoneNumber=:phoneNumber, birthday=:birthday,gmail=:gmail,password=:password,role=:role
    WHERE iduser=:iduser";
    $stmt = $stmtConn->prepare($query);
    $stmt->bindParam(":username",$user->username);
    $stmt->bindParam(":fullName",$user->fullName);
    $stmt->bindParam(":nationality",$user->nationality);
    $stmt->bindParam(":phoneNumber",$user->phoneNumber);
    $stmt->bindParam(":birthday",$user->birthday);
    $stmt->bindParam(":gmail",$user->gmail);
    $stmt->bindParam(":password",$user->password);
    $stmt->bindParam(":role",$user->role);
    $stmt->bindParam(":iduser",$user->iduser);
    if($stmt->execute()) {
     // Update post

        echo json_encode(
            array('message' => 'Account Updated')
        );
  
        return true;
    }   
    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);
    echo json_encode(
        array('message' => 'Account Not Updated')
      );
  
    return false;

}else{
    $query = "UPDATE _utilisateur SET 
    username=:username, fullName=:fullName, nationality=:nationality, phoneNumber=:phoneNumber, birthday=:birthday,gmail=:gmail,profilPic=:profilPic,password=:password,role=:role
    WHERE iduser=:iduser";
    $stmt = $stmtConn->prepare($query);
    $stmt->bindParam(":username",$user->username);
    $stmt->bindParam(":fullName",$user->fullName);
    $stmt->bindParam(":nationality",$user->nationality);
    $stmt->bindParam(":phoneNumber",$user->phoneNumber);
    $stmt->bindParam(":birthday",$user->birthday);
    $stmt->bindParam(":gmail",$user->gmail);
    $stmt->bindParam(":profilPic",$user->profilPic);
    $stmt->bindParam(":password",$user->password);
    $stmt->bindParam(":role",$user->role);
    $stmt->bindParam(":iduser",$user->iduser);
    if($stmt->execute()) {
        // Update post
   
           echo json_encode(
               array('message' => 'Account Updated')
           );
     
           return true;
       }   
       // Print error if something goes wrong
       printf("Error: %s.\n", $stmt->error);
       echo json_encode(
           array('message' => 'Account Not Updated')
         );
     
       return false;
   
}
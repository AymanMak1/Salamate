<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Actualite.php';
  
  // instantiate the DB & CONNECT
  
  $database = new Database();
  $db = $database->connect();
  
  // create actualite object
  $actualite = new Actualite($db);

  // Get raw posted data
 // $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $actualite->title=utf8_encode($_REQUEST['title']);
  $actualite->publicationDate=$_REQUEST['publicationDate'];
  $actualite->description=utf8_encode($_REQUEST['description']);
  $actualite->published=$_REQUEST['published'];
  $actualite->idavis = $_REQUEST['idavis'];

  // Update post
  if($actualite->update()) {
    echo json_encode(
      array('message' => 'Actualite Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Actualite Not Updated')
    );
  }

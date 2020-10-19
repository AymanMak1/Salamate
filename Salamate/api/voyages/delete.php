<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../../SalamateDashboard/config/Database.php';
include_once '../../models/Voyage.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// create a trip object

$voyage= new Voyage($db);

// GET THE ID OF THE USER
$tripToDelete = $_REQUEST['idtrip'];

//$data = json_decode(file_get_contents("php://input"));

// SET ID to update
$voyage->idtrip= $tripToDelete;

// delete post
if($voyage->delete()){
    echo json_encode(
        array('message' => 'User deleted')
    );
      $query = 'DELETE FROM _abesoin WHERE idtrip = :idtrip ';
      $stmt = $db->prepare($query);
      $stmt->bindParam(':idtrip', $tripToDelete);
      $stmt->execute() ;

}else{
    echo json_encode(
        array('message' => 'User not deleted')
    );
}
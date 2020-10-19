<?php


// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Maladie.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$maladie = new Maladie($db);

// GET THE RAW POSTED DATA
//$data = json_decode(file_get_contents("php://input"));

$maladie->diseaseName=utf8_encode($_REQUEST['diseaseName']);
$idcountry=utf8_encode($_REQUEST['idcountry']);

// Create Disease
if($maladie->create()){

    // Insert the posted data _maladie Table
    
    echo json_encode(
        array('message' => 'Disease has been added with success Created')
    );
    

    // Insert the foreign keys to _maladiespays Table
    // get the id of the last inserted disease
    $lastInsertedId = $db->lastInsertId();
    $query= "INSERT INTO _maladiespays (idcountry,iddisease) VALUES (?,?)";
    $stmt= $db->prepare($query);
    $stmt->bindParam(1,$idcountry);
    $stmt->bindParam(2,$lastInsertedId);
    if($stmt->execute()) {
        return true;       
    }


}else{
    echo json_encode(
        array('message' => 'Something Went Wrong')
    );
}
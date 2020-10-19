<?php


// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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
$maladie->idcountry=utf8_encode($_REQUEST['idcountry']);
$maladie->iddisease=utf8_encode($_REQUEST['iddisease']);


// Create Disease
if($maladie->update()){

    // updated the posted data _maladie Table
    
    echo json_encode(
        array('message' => 'Disease has been Updated with success Created')
    );
    

    // Insert the foreign keys to _maladiespays Table
    // get the id of the last inserted disease
    $query= "UPDATE _maladiespays SET idcountry = ?, iddisease = ? WHERE iddisease = ?";
    $stmt= $db->prepare($query);
    $stmt->bindParam(1,$maladie->idcountry);
    $stmt->bindParam(2,$maladie->iddisease);
    $stmt->bindParam(3,$maladie->iddisease);
    if($stmt->execute()) {
        return true;       
    }


}else{
    echo json_encode(
        array('message' => 'Something Went Wrong')
    );
}
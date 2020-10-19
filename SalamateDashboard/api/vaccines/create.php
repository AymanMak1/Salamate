<?php


// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Vaccine.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$vaccine = new Vaccine($db);

// GET THE RAW POSTED DATA
//$data = json_decode(file_get_contents("php://input"));

$vaccine->vaccineName=utf8_encode($_REQUEST['vaccineName']);
$vaccine->iddisease=$_REQUEST['iddisease'];
$vaccine->vaccineInfos=utf8_encode($_REQUEST['vaccineInfos']);
$vaccine->nbrDoses=$_REQUEST['nbrDoses'];
$vaccine->daysBetween = $_REQUEST['daysBetween'];

// Create Disease
if($vaccine->create()){
    
    echo json_encode(
        array('message' => 'Vaccine has been added with success')
    );

    $queryToGetIdCountry = "SELECT distinct p.idcountry 
    FROM _pays p ,_vaccin v,_maladie m,_maladiespays mp 
    WHERE v.iddisease = m.iddisease AND m.iddisease = mp.iddisease AND 
    mp.idcountry = p.idcountry AND v.idvaccine =:idvaccine";
    $lastInsertedId = $db->lastInsertId();
    $stmtToGetIdCountry = $db->prepare($queryToGetIdCountry);
    $stmtToGetIdCountry->bindParam(":idvaccine",$lastInsertedId);
    $stmtToGetIdCountry->execute();
    $data = $stmtToGetIdCountry->fetch();
    $idcountry=$data['idcountry'];
    //select distinct p.idcountry From _pays p ,_vaccin v,_maladie m,_maladiespays mp WHERE v.iddisease = m.iddisease AND m.iddisease = mp.iddisease AND mp.idcountry = p.idcountry WHERE idvaccine =:idvaccine;

    $query= "INSERT INTO _vaccinspays (idcountry,idvaccine) VALUES (?,?)";
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
<?php
// Headers
session_start();
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../../SalamateDashboard/config/Database.php';
include_once '../../models/Voyage.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$voyage = new Voyage($db);

// GET THE RAW POSTED DATA

$voyage->iduser=$_SESSION['iduser'];
$voyage->tripName=$_POST['tripName'];
$voyage->tripDeparture=utf8_encode($_POST['tripDeparture']);
$voyage->tripDestination=utf8_encode($_POST['tripDestination']);
$voyage->tripStartDate=$_POST['tripStartDate'];
$voyage->tripEndDate=$_POST['tripEndDate'];

// Create a trip
if($voyage->create()){
    echo json_encode(
        array('message' => 'trip Created')
    );
    $lastInsertedId = $db->lastInsertId();
    $iduser = $_SESSION['iduser'];
    // query to get the ids of the vaccins recommended for the trip
    $queryGetVaccineIds="SELECT v.idvaccine FROM _pays p,_vaccin v,_maladie m,_voyage vo, _vaccinspays vp 
    WHERE vp.idcountry = p.idcountry and v.idvaccine = vp.idvaccine and v.iddisease = m.iddisease
    and vo.tripDestination = p.countryNameEng and iduser=:iduser AND idtrip = :idtrip";
    $stmt = $db->prepare($queryGetVaccineIds);
    $stmt->bindParam(":iduser",$iduser);
    $stmt->bindParam("idtrip",$lastInsertedId);
    $stmt->execute();

    $query2= "INSERT INTO _abesoin (idvaccine,idtrip) VALUES (?,?)";
    $stmt2= $db->prepare($query2);

    $query3= "INSERT INTO _vaccination (iduser,idvaccine) VALUES (?,?)";
    $stmt3= $db->prepare($query3);
  
   while ($idvaccine = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $stmt2->bindParam(1,$idvaccine['idvaccine']);
        $stmt2->bindParam(2,$lastInsertedId);
        $stmt2->execute(); 

        $stmt3->bindParam(1,$voyage->iduser);
        $stmt3->bindParam(2,$idvaccine['idvaccine']);
        $stmt3->execute();
    }   
}else{
    echo json_encode(
        array('message' => 'trip not Created')
    );
}
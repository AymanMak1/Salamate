<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Maladie.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Get single Disease after creating in order to add it to the data tables

  $query = "SELECT m.iddisease, p.abrCountry,p.countryNameFr,m.diseaseName, m.addedAt
  FROM _maladie m ,_pays p, _maladiespays mp 
  WHERE p.idcountry = mp.idcountry AND mp.iddisease = m.iddisease ORDER BY m.iddisease DESC LIMIT 1  ";
  
  $stmt=$db->prepare($query);

  $stmt->execute();

  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
  // SET PROPERTIES
  //$valideDisease_arr = array();
  /*
  $disease_arr = array(
          "iddisease" =>  intval($row['iddisease']),
          "abrCountry" => $row['abrCountry'],
          "countryNameFr" =>  $row['countryNameFr'],
          "diseaseName" => $row['diseaseName'],
          "addedAt" => $row['addedAt']
  );
*/

  //array_push ($valideDisease_arr,$disease_arr);
  // Make JSON

  echo json_encode($row,JSON_UNESCAPED_UNICODE);


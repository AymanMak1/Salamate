<?php
    include_once('../../conn/conn.php');
    $queryFetchCountries= "SELECT countryNameEng FROM _pays ORDER BY countryNameEng";
    $stmt = $db->prepare($queryFetchCountries);
    $stmt->execute();
    $countries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($countries);
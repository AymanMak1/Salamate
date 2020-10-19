<?php

require_once("../../conn/conn.php");

$query = "SELECT * from _avisvoyages WHERE published = 1 ORDER BY publicationDate DESC LIMIT 1";
$stmt = $db->prepare($query);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$actualite_arr = array();
$actualite_items = array(
    "idavis" => $row['idavis'],
    "title" => $row['title'],
    "publicationDate" => $row['publicationDate'],
    "description" => $row['description'],
);
array_push($actualite_arr,$actualite_items);
echo json_encode($actualite_arr);
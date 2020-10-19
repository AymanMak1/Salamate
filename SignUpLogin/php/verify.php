<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once ('../../conn/conn.php');

$username = htmlspecialchars($_POST['username']);
$gmail = htmlspecialchars($_POST['gmail']);
$tel = htmlspecialchars($_POST['tel']);

$reqmail = $db->prepare("SELECT gmail FROM _utilisateur WHERE gmail = ?");
$reqmail->execute([$gmail]);
$mailexist = $reqmail->rowCount();
if($mailexist == 1) {
    $error="Gmail already exists";
    echo json_encode($error);
    exit();
}

$requsername = $db->prepare("SELECT username FROM _utilisateur WHERE username = ?");
$requsername->execute([$username]);
$usernameexist = $requsername->rowCount();

if($usernameexist == 1) {
    $error='Username already exists';
    echo json_encode($error);
    exit();
}

$reqtel = $db->prepare("SELECT phoneNumber FROM _utilisateur WHERE phoneNumber = ?");
$reqtel->execute([$tel]);
$telexist = $reqtel->rowCount();

if($telexist == 1) {
    $error='Phone number already exists';
    echo json_encode($error);
    exit();
}

echo json_encode("success");

?>
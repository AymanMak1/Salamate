<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instatiate DB & connect

$database = new Database();
$db = $database->connect();

// Instatiate user object
$user = new User($db);

// GET THE ID
$user->iduser = isset($_GET['iduser']) ? $_GET['iduser'] : die();

//GET POST
$user->read_single();

// Create array
$user_arr = array(
    "iduser" => $user->iduser,
    "username" => $user->username,
    "fullName" => $user->fullName,
    "nationality" => $user->nationality,
    "phoneNumber" => $user->phoneNumber,
    "birthday" => $user->birthday,
    "gmail" => $user->gmail,
    "profilPic" => $user->profilPic,
    "password" => $user->password,
    "vkey" => $user->vkey,
    "verified" => $user->verified,
    "role" => $user->role,
    "createdAt" => $user->createdAt
);

// Make JSON
echo (json_encode($user_arr));  
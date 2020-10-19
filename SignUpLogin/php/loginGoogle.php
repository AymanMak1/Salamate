<?php 

require_once ('../../conn/conn.php');
session_start();

require_once ('GoogleApi/src/Google/autoload.php');
// instanciate a new google client
$gClient = new Google_Client();
// instanciate a new google client
$gClient->setClientId();
$gClient->setClientSecret();
// AIzaSyBL5VkUqMFwsMHw7UycObWf0rICIn1H6Zo  
// AIzaSyDsR75VgKpqUYBMU6KSkzgfmBmgQNSAt-w

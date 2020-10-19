<?php
 $servername = "localhost";
 $username = "root";
 $password = "";

 try {
 $db = new PDO("mysql:host=$servername;dbname=salamate", $username, $password);
 // set the PDO error mode to exception
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $db->exec("set names utf8");
 } catch(PDOException $e) {
 echo "Connection failed: " . $e->getMessage();
 }
<?php
/*
  $connString = "mysql:host=localhost;dbname =PawsPetsStore";
  $user ="root";
  $pass="root";

  $pdo = new pdo($connString,$user,$pass);
  
 try {
    $pdo = new PDO($connString, $user, $pass);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
*/


$connString = "mysql:host=localhost; dbname=PawsPetStore";
$user="root";
$pass="root";

$pdo=new pdo($connString,$user,$pass);

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_SILENT);


?>
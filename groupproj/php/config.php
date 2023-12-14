<?php

$connString = "mysql:host=localhost; dbname=PawsPetStore";
$user="root";
$pass="root";

$pdo=new pdo($connString,$user,$pass);

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_SILENT);


?>
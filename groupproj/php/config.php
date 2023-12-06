<?php

  $connString = "mysql:host = localhost; dbname =PawsPetStore";
  $user ="pawspets";
  $pass="pawesome";

  $pdo = new pdo($connString,$user,$pass);

  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

?>
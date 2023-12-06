<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php

ini_set('session.use_cookies','0');
ini_set('session.use_only_cookies','0');

session_start();
//check if any input is empty




require_once("config.php");

$TableName = "users";
$firstName =$_GET['firstname'];
$lastName=$_GET['lastname'];
$Email=$_GET['email'];
$passWord=$_GET['password'];


$sql="SELECT * FROM $TableName"; //check if user registered already
$result = pdo->query($sql);
while($row = $result->fetch()){
  if($row[''] ==$Email)
  exit("<p> The email you entered is already in use. Please use another.</p>");
}

//if user isnt registered, add them to the table refer to register flyer.php flyer3
  $sql="INSERT INTO $TableName ();
  $result = $pdo->prepare($sql);
  $result->execute(array(":em"=>$Email,":ps"=>$passWord));
  $row =$result->fetch();
  $userID=$row['userID'];
  setcookie("userID",$userID); //setting cookie now

  $pdo =null;
?>
</body>
</html>

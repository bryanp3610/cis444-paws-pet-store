<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>signup</title>
</head>
<body>
<?php

//check if any input is empty
if(empty($_GET['firstname']) || empty($_GET['lastname']) || empty($_GET['email']) || empty($_GET['password']))
  exit("<p> Please enter information in all the input fields ! </p>");

require_once("config.php");

$TableName = "users";
$firstname =$_GET['firstname'];
$lastname=$_GET['lastname'];
$email=$_GET['email'];
$password=$_GET['password'];


$sql="SELECT * FROM $TableName"; //check if user registered already
$result = pdo->query($sql);
while($row = $result->fetch()){
  if($row['email'] ==$email)
  exit("<p> The email you entered is already in use. Please use another.</p>");
}

//if user isnt registered, add them to the table 
  $sql="INSERT INTO $TableName ();
  $result = $pdo->prepare($sql);
  $result->execute(array(":em"=>$email,":ps"=>$password));
  $row =$result->fetch();
  $userID=$row['userID'];
  setcookie("userID",$userID); //setting cookie now

  $pdo = null; //close connection
?>


</body>
</html>

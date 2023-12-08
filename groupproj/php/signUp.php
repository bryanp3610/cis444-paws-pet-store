<?php

//check if any input is empty
if(empty($_GET['firstname']) || empty($_GET['lastname']) || empty($_GET['email']) || empty($_GET['password']))
  exit("<p> Please enter information in all the input fields ! </p>");


require_once("config.php");

$TableName = "users";
$firstName =$_GET['firstname'];
$lastName=$_GET['lastname'];
$email=$_GET['email'];
$password=$_GET['password'];

echo($email);
echo($password);
echo($firstName);
echo($lastName);

$sql="SELECT * FROM $TableName"; //check if user registered already
$result = $pdo->query($sql);
while($row = $result->fetch()){
  if($row['email'] ==$email)
  exit("<p> The email you entered is already in use. Please use another.</p>");
}
//insert user into table

  $sql="INSERT INTO $TableName VALUES(NULL,:fn,:ln, :em,:ps)";
  $result = $pdo->prepare($sql);
  $result->execute(array(":fn"=>$firstName, ":ln"=>$lastName, ":em"=>$email,":ps"=>$password));

  $row =$result->fetch();
  $userID=$row['userID'];
 // $_SESSION['userID']=$userID;
  setcookie("userID",$userID); //setting cookie now

  $pdo = null; //close connection

?>








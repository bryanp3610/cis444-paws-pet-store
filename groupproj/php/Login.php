<?php

    require_once "config.php";
    if(isset($_POST['email']) && isset($_POST['password'])){
        function validate($temp){
        $temp = trim($temp);
        $temp = stripslashes($temp);
        $temp = htmlspecialchars($temp);
        return $temp;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    
    if(empty($email)){
        header("location: ../login.html?errorEmail is required");
        die();
     }   else if(empty($pass)){
            header("location: ../login.html?errorPassword is required");
            die();
            } else{
                $sql = "SELECT * FROM users WHERE email='$email' AND passowrd ='$pass'";
                $result = $pdo->query($sql);
                $row = $result->fetch();
                if($row['email'] === $email && $row['passowrd']=== $pass){
                    header("location: userpage.php");
                    die();
                }
    }} else{
        header("location: ../login.html");
        die();
    }

?>
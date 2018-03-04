<?php

session_start();

require_once 'db.php';

$username=$_POST["username"];
$password=$_POST["password"];

$stmt = $pdo->prepare('SELECT username, password FROM user WHERE username=?');
$stmt->execute([$username]);
$getuser = $stmt->fetch();

$hashed_password = $getuser['password'];

if($stmt->rowCount() > 0){
    if(password_verify($password, $hashed_password)){
      $_SESSION["username"] = $_POST["username"];
      header("location: ../controlpanel.php");
    } else {
      echo "Incorrect Password";
    }
  } else {
    echo "Incorrect Username or Password";
}


?>

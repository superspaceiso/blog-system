<?php

require_once 'db.php';

$username=$_POST[""]
$password=$_POST[""]

$stmt = $pdo->prepare('SELECT username, password FROM user WHERE username=?');
$stmt->execute([$username]);
$getuser = $stmt->fetchAll();

foreach ($getuser as $userinfo) {
  $hashed_password = $userinfo["password"];
  if (password_verify($password, $hashed_password)) {
      echo "Corrent";
  } else {
      echo "Incorrect";
  }
}

?>

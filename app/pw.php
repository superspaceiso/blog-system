<?php

//require_once 'db.php';

$username = 'Test User';
$password = 'hash';

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

print_r($hashed_password);

//$stmt = $pdo->query('INSERT INTO user');



?>

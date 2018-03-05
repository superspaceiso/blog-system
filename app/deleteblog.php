<?php

require_once 'db.php';

$blog_id=$_GET["b"];

$sql = 'DELETE FROM blog_posts WHERE blogid = ?';
$stmt= $pdo->prepare($sql);
$stmt->execute([$blog_id]);

header("location: ../controlpanel.php");


?>

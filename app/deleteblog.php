<?php

require_once 'db.php';

$blog_id=$_GET["b"];

$delete = $pdo->prepare('DELETE FROM blog_posts WHERE blogid = ?');
$delete->execute([$blog_id]);

header("location: ../controlpanel.php");


?>

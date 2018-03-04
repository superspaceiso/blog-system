<?php
date_default_timezone_set('UTC');

require_once 'db.php';

$blog_title=$_POST[""]
$blog_content=$_POST[""]
$blog_date = date("Y-m-d");

$sql = 'INSERT INTO blog_posts (blogtitle, blogcontent, blogdate) VALUES (?,?,?)';
$stmt= $pdo->prepare($sql);
$stmt->execute([$blog_title, $blog_content, $blog_date]);


?>

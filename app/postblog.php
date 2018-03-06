<?php
date_default_timezone_set('UTC');

require_once 'db.php';

$user_id =$_POST["id"];
$blog_title=$_POST["title"];
$blog_content=$_POST["content"];
$blog_date = date("Y-m-d");

$sql = 'INSERT INTO blog_posts (userid, blogtitle, blogcontent, blogdate) VALUES (?,?,?,?)';
$stmt= $pdo->prepare($sql);
$stmt->execute([$user_id, $blog_title, $blog_content, $blog_date]);

if ($stmt->execute() == 1 ) {
  echo "Success";
  //header("location: ../controlpanel.php");
} else {
  echo "Fail";
}



?>

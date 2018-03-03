<?php

$blogid = $_GET['b'];

require_once 'db.php';

$stmt = $pdo->prepare('SELECT * FROM blog_posts WHERE blogid=?');
$stmt->execute([$blogid]);
$posts = $stmt->fetchAll();

foreach ($posts as $blogpost) {
  $blog_title = $blogpost['blogtitle'];
  $blog_content = $blogpost['blogcontent'];
  $blog_date = strtotime($blogpost['blogdate']);


  echo "<strong>",$blog_title,"</strong><br>";
  echo $blog_content,"<br>";
  echo date('d/m/Y', $blog_date),"<br>";

}

?>

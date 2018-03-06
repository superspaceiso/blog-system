<?php

$blogid = $_GET['b'];

require_once 'db.php';

$stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid WHERE blogid=?');
$stmt->execute([$blogid]);
$posts = $stmt->fetchAll();

foreach ($posts as $blogpost) {
  $blog_id = $blogpost['blogid'];
  $blog_title = $blogpost['blogtitle'];
  $blog_content = $blogpost['blogcontent'];
  $blog_date = strtotime($blogpost['blogdate']);
  $blog_author = $blogpost['username'];


  echo "<strong>",$blog_title,"</strong><br>";
  echo $blog_content,"<br>";
  echo date('d/m/Y', $blog_date),"<br>";
  echo $blog_author;

}

?>

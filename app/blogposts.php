<?php

require_once 'db.php';

$stmt = $pdo->query('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate,user.userid, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid');
$stmt->execute();
$posts = $stmt->fetchAll();

print_r($posts);

foreach ($posts as $blogpost) {
  $blog_id = $blogpost['blogid'];
  $blog_title = $blogpost['blogtitle'];
  $blog_content = $blogpost['blogcontent'];
  $blog_date = strtotime($blogpost['blogdate']);
  $blog_author = $blogpost['username'];

  echo "<strong><a href=\"./app/blog.php?b=$blog_id\">",$blog_title,"</a></strong><br>";
  echo $blog_content,"<br>";
  echo $blog_author," ", date('d/m/Y', $blog_date),"<br>";

}

?>

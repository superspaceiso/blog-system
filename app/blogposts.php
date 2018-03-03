<?php

require_once 'db.php';

$stmt = $pdo->query('SELECT * FROM blog_posts');
$stmt->execute();
$posts = $stmt->fetchAll();

//print_r($posts);

foreach ($posts as $blogpost) {
  $blog_id = $blogpost['blogid'];
  $blog_title = $blogpost['blogtitle'];
  $blog_content = $blogpost['blogcontent'];
  $blog_date = strtotime($blogpost['blogdate']);

  echo "<strong><a href=\"./app/blog.php?b=$blog_id\">",$blog_title,"</a></strong><br>";
  echo $blog_content,"<br>";
  echo date('d/m/Y', $blog_date),"<br>";

}

?>

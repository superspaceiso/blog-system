<?php

require 'db.php';

$stmt = $pdo->query('SELECT blog_posts.blogid,blog_posts.userid,blog_posts.blogtitle,blog_posts.blogcontent,blog_posts.blogdate FROM blog_posts');
$stmt->execute();
$posts = $stmt->fetchAll();

echo "<table>";
echo "<tr><th>Title</th><th>Date</th><th></th></tr>";


foreach ($posts as $blogpost) {
  $blog_id = $blogpost['blogid'];
  $correct_date = strtotime($blogpost['blogdate']);
  $blog_title = $blogpost['blogtitle'];

  echo "<tr><td><a href=\"./blog.php?b=$blog_id\">",$blog_title,"</a></td><td>",date('d/m/Y', $correct_date),"</td><td><button type=\"button\">Delete</button></td></tr>";
}

echo "</table>";

?>

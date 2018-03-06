<?php

require 'db.php';

$user_id = $_SESSION["id"];

$stmt = $pdo->prepare('SELECT blogid,userid,blogtitle,blogcontent,blogdate FROM blog_posts WHERE userid=?');
$stmt->execute([$user_id]);
$posts = $stmt->fetchAll();

echo "<table>";
echo "<tr><th>Title</th><th>Date</th><th></th><th></th></tr>";


foreach ($posts as $blogpost) {
  $blog_id = $blogpost['blogid'];
  $correct_date = strtotime($blogpost['blogdate']);
  $blog_title = $blogpost['blogtitle'];

  echo "<tr><td><a href=\"./app/blog.php?b=$blog_id\">",$blog_title,"</a></td><td>",date('d/m/Y', $correct_date),"</td><td><a href=\"./app/editblog.php?b=$blog_id\">Edit</a></td></td><td><a href=\"./app/deleteblog.php?b=$blog_id\">Delete</a></td></tr>";
}

echo "</table>";

?>

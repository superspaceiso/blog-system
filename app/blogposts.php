<?php

require_once 'db.php';

$stmt = $pdo->query('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.userid, user.username FROM blog_posts LEFT JOIN user ON blog_posts.userid=user.userid');
$stmt2 = $pdo->prepare('SELECT blog_posts.blogid, tag_map.blogid, tag_map.tagid, test_tags.tagid, test_tags.tag FROM blog_posts INNER JOIN tag_map ON blog_posts.blogid=tag_map.blogid INNER JOIN test_tags ON tag_map.tagid=test_tags.tagid WHERE blog_posts.blogid=?');
$stmt->execute();
$getposts = $stmt->fetchAll();

foreach ($getposts as $blogpost) {
  $blog_id = $blogpost['blogid'];
  $blog_title = $blogpost['blogtitle'];
  $blog_content = $blogpost['blogcontent'];
  $blog_date = strtotime($blogpost['blogdate']);
  $blog_author = $blogpost['username'];
  $stmt2->execute([$blog_id]);
  $gettags = $stmt2->fetchAll();

  echo "<strong><a href=\"./app/blog.php?b=$blog_id\">",$blog_title,"</a></strong><br>";
  echo $blog_content,"<br>";

  echo "Tags: ";
  foreach ($gettags as $blogtags) {
    echo  $blogtags['tag']," ";
  }
  echo "<br>";
  echo $blog_author," ", date('d/m/Y', $blog_date),"<br>";

}

?>

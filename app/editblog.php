<?php

require_once 'db.php';

$id=$_GET["b"];

$getpost = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent FROM blog_posts WHERE blogid=?');
$gettags = $pdo->prepare('SELECT blog_posts.blogid, tag_map.blogid, tag_map.tagid, test_tags.tagid, test_tags.tag FROM blog_posts INNER JOIN tag_map ON blog_posts.blogid=tag_map.blogid INNER JOIN test_tags ON tag_map.tagid=test_tags.tagid WHERE blog_posts.blogid=?');

$getpost->execute([$id]);
$post = $getpost->fetchAll();

foreach ($post as $blogpost) {
  $blog_id = $blogpost['blogid'];
  $blog_title = $blogpost['blogtitle'];
  $blog_content = $blogpost['blogcontent'];
  $gettags->execute([$blog_id]);
  $tags = $gettags->fetchAll();

  echo "<h1>New Post</h1>";
  echo "<form id=\"contentform\" action=\"/update.php\" method=\"post\">";
  echo "<input class=\"u-full-width\" type=\"text\" name=\"title\" value=\"$blog_title\"></input><br>";
  echo "<textarea class=\"u-full-width\" name=\"content\">",$blog_content,"</textarea><br>";
  echo "<input  class=\"u-full-width\" type=\"text\" name=\"tags\" value=\" ";
  foreach ($tags as $blogtags) {
    $blog_tag=$blogtags["tag"];
    echo $blog_tag;
  }
  echo "\"></input><br>";
  echo "<button class=\"button-primary\">Update</button>";
  echo "</form>";

}

?>

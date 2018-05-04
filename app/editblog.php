<?php

require_once 'db.php';

$id=$_GET["b"];

$getpost = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent FROM blog_posts WHERE blogid=?');
$gettags = $pdo->prepare('SELECT blog_posts.blogid, tag_map.blogid, tag_map.tagid, test_tags.tagid, test_tags.tag FROM blog_posts INNER JOIN tag_map ON blog_posts.blogid=tag_map.blogid INNER JOIN test_tags ON tag_map.tagid=test_tags.tagid WHERE blog_posts.blogid=?');

$getpost->execute([$id]);
$post = $getpost->fetchAll();

foreach ($post as $blogpost) {
  $user_id = $blogpost['userid'];
  $blog_id = $blogpost['blogid'];
  $blog_title = $blogpost['blogtitle'];
  $blog_content = $blogpost['blogcontent'];
  $gettags->execute([$blog_id]);
  $tags = $gettags->fetchAll();
  $comma_sep = implode(", ", array_column($tags, 'tag'));

  echo "<h1>New Post</h1>";
  echo "<form id=\"contentform\" action=\"./update.php\" method=\"post\">";
  echo "<input type=\"hidden\" name=\"blogid\" value=\"$blog_id\"></input>";
  echo "<input class=\"u-full-width\" type=\"text\" name=\"title\" value=\"$blog_title\"></input><br>";
  echo "<textarea class=\"u-full-width\" name=\"content\">",$blog_content,"</textarea><br>";
  echo "<input class=\"u-full-width\" type=\"text\" name=\"tags\" value=\"$comma_sep\"></input><br>";
  echo "<button class=\"button-primary\">Update</button>";
  echo "</form>";

}

?>

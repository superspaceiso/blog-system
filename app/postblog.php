<?php
date_default_timezone_set('UTC');

require_once 'db.php';

$user_id =$_POST["id"];
$blog_title=$_POST["title"];
$blog_content=$_POST["content"];
$blog_date = date("Y-m-d");
$tags = explode(",",$_POST["tags"]);

$postcontent = $pdo->prepare('INSERT INTO blog_posts (userid, blogtitle, blogcontent, blogdate) VALUES (?,?,?,?)');
$posttags = $pdo->prepare('INSERT INTO test_tags (tag) VALUES (?)');
$tagsearch = $pdo->prepare('SELECT tag FROM test_tags WHERE tag=?');

foreach ($tags as $blog_tag) {
  $tagsearch->execute([$blog_tag]);
  $foundtags = $tagsearch->rowCount();
  if ($foundtags == 0) {
    $posttags->execute([$blog_tag]);
    $postcontent->execute([$user_id, $blog_title, $blog_content, $blog_date]);
    header("location: ../controlpanel.php");
  } else {
    $postcontent->execute([$user_id, $blog_title, $blog_content, $blog_date]);
    header("location: ../controlpanel.php");
  }
}

?>

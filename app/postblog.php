<?php
date_default_timezone_set('UTC');

require_once 'db.php';

$user_id =$_POST["id"];
$blog_title=$_POST["title"];
$blog_content=$_POST["content"];
$blog_date = date("Y-m-d");
$tags = $_POST["tags"];

$postcontent = $pdo->prepare('INSERT INTO blog_posts (userid, blogtitle, blogcontent, blogdate) VALUES (?,?,?,?)');
$posttags = $pdo2->prepare('INSERT INTO test_tags (tag) VALUES (?)');
$tagsearch = $pdo->prepare('SELECT tagid,tag FROM test_tags WHERE tag=?');
$tagmap = $pdo->prepare('INSERT INTO tag_map (blogid,tagid) VALUES (?,?)');

if (empty($tags)){
  $postcontent->execute([$user_id, $blog_title, $blog_content, $blog_date]);
  header("location: ../controlpanel.php");
}
elseif (isset($tags)){
  $exploded_tags = array_map("trim",explode(",",$tags));
  $postcontent->execute([$user_id, $blog_title, $blog_content, $blog_date]);
  $blog_id = $pdo->lastInsertId();
    foreach ($exploded_tags as $blog_tag) {
      $tagsearch->execute([$blog_tag]);
      $gettags = $tagsearch->fetchAll();
      $counttags = $tagsearch->rowCount();
      if ($counttags === 0) {
        $posttags->execute([$blog_tag]);
        $tag_id = $pdo2->lastInsertId();
        $tagmap->execute([$blog_id,$tag_id]);
        header("location: ../controlpanel.php");
      }
      elseif ($counttags = 1) {
        foreach ($gettags as $storredtag) {
          $tagmap->execute([$blog_id,$storredtag['tagid']]);
        }
        header("location: ../controlpanel.php");
      }
    }
}


?>

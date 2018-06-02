<?php

require_once 'db.php';

$blog_id= $_POST["blogid"];
$blog_title=$_POST["title"];
$blog_content=$_POST["content"];
$tags = $_POST["tags"];

$post_content = $pdo->prepare('UPDATE blog_posts SET blogtitle = ?, blogcontent = ? WHERE blogid = ?');
$post_tags = $pdo2->prepare('INSERT INTO test_tags (tag) VALUES (?)');
$tag_search = $pdo->prepare('SELECT tagid,tag FROM test_tags WHERE tag=?');
$tag_map = $pdo->prepare('REPLACE INTO tag_map (blogid,tagid) VALUES (?,?)');
$remove_tag = $pdo->prepare('DELETE FROM tag_map WHERE blogid = ? AND tagid = ?');
$retrieve_tags = $pdo->prepare('SELECT test_tags.tag FROM blog_posts INNER JOIN tag_map ON blog_posts.blogid=tag_map.blogid INNER JOIN test_tags ON tag_map.tagid=test_tags.tagid WHERE blog_posts.blogid=?');

if (empty($tags)){
  $post_content->execute([$blog_title, $blog_contentm,$blog_id]);
  header("location: ../controlpanel.php");
}
elseif (isset($tags)){
  $new_exploded_tags = array_map("trim",explode(",",$tags));
  $post_content->execute([$blog_title, $blog_content, $blog_id]);
  $retrieve_tags->execute([$blog_id]);
  $storred_tags = $retrieve_tags->fetchAll(PDO::FETCH_COLUMN);
  //Checks to see if any of the original tags have been removed.
  $unmatched_tags = array_diff($storred_tags, $new_exploded_tags);
  //Checks to see if there are any new tags.
  $new_unmatched_tags = array_diff($new_exploded_tags, $storred_tags);
  //Removes tags from tag_map if the new input no longer has the same tags.
  if($unmatched_tags > 0){
    foreach ($unmatched_tags as $blog_tag){
      $tag_search->execute([$blog_tag]);
      $get_tags = $tag_search->fetch();
      $remove_tag->execute([$blog_id,$get_tags['tagid']]);
    }
  }
  //Inserts the new tags into the DB while checking to see if the tag is already storred within the DB and updating the tag_map table.
  if($new_unmatched_tags > 0){
    foreach ($new_unmatched_tags as $blog_tag){
      $tag_search->execute([$blog_tag]);
      $get_tags = $tag_search->fetchAll();
      $count_tags = $tag_search->rowCount();
      if($count_tags === 0){
        $post_tags->execute([$blog_tag]);
        $tag_id = $pdo2->lastInsertId();
        $tag_map->execute([$blog_id,$tag_id]);
        header("location: ../controlpanel.php");
      }
      elseif ($count_tags == 1) {
        foreach ($get_tags as $db_tag) {
          $tag_map->execute([$blog_id,$db_tag['tagid']]);
          header("location: ../controlpanel.php");
        }
      }
    }
  }
}
?>

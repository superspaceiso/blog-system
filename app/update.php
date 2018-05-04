<?php
require_once 'db.php';

$blog_id=$_POST["blogid"];
$blog_title=$_POST["title"];
$blog_content=$_POST["content"];
$tags = $_POST["tags"];

$postcontent = $pdo->prepare('UPDATE blog_posts SET blogtitle = ?, blogcontent = ? WHERE blogid = ?');
$posttags = $pdo2->prepare('INSERT INTO test_tags (tag) VALUES (?)');
$tagsearch = $pdo->prepare('SELECT tagid,tag FROM test_tags WHERE tag=?');
$tagmap = $pdo->prepare('INSERT INTO tag_map (blogid,tagid) VALUES (?,?)');

$exploded_tags = explode(",",$tags);
$trimmed_tags = array_map("trim",$exploded_tags);
$postcontent->execute([$blog_title, $blog_content, $blog_id]);

header("location: ../controlpanel.php");

?>

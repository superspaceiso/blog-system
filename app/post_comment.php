<?php

require_once 'db.php';

$comment_blog = $_POST["comment_blog"];
$comment_parent = $_POST["comment_parent"];
$comment_email = $_POST["comment_email"];
$comment_name = $_POST["comment_name"];
$comment_msg = $_POST["comment_msg"];

$post_comment = $pdo->prepare('INSERT INTO blog_comments (parentcommentid, blogid, comment, commentname, commentemail) VALUES (?,?,?,?)');

$postcontent->execute([$comment_parent, $comment_blog, $comment_msg, $comment_name, $comment_email]);

?>

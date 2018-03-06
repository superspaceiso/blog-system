<?php
header("Content-Type: application/rss+xml; charset=ISO-8859-1");

require_once 'db.php';

$stmt = $pdo->query('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid');
$stmt->execute();
$posts = $stmt->fetchAll();


echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
echo "<rss version=\"2.0\">\n";
echo "<channel>\n";
echo "<title>Blog</title>\n";
echo "<link></link>\n";
echo "<description></description>\n\n";

foreach ($posts as $blogpost) {
  $blog_id = $blogpost['blogid'];
  $blog_title = $blogpost['blogtitle'];
  $blog_content = $blogpost['blogcontent'];
  $blog_date = strtotime($blogpost['blogdate']);
  $blog_author = $blogpost['username'];

  echo "<item>\n";
    echo "<title>",$blog_title,"</title>\n";
    echo "<link>","</link>\n";
    echo "<pubDate>","</pubDate>\n";
    echo "<description>","</description>\n";
  echo "</item>\n";

}

echo "</channel>\n</rss>";

?>

<?php

require 'db.php';

$stmt = $pdo->query('SELECT * FROM blog_posts');
$stmt->execute();
$posts = $stmt->fetchAll();

echo "<table>";
echo "<tr><th>Title</th><th>Date</th><th></th></tr>";


foreach ($posts as $blogpost) {
  $correct_date = strtotime($blogpost['blogdate']);
  $blog_title = $blogpost['blogtitle'];

  echo "<tr><td>"<a href=,$blog_title,"</td><td>",date('d/m/Y', $correct_date),"</td><td><button type=\"button\">Delete</button></td></tr>";
}

echo "</table>";

?>

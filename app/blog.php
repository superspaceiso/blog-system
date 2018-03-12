<?php

require_once 'db.php';

if (isset($_GET['b'])){

  $id = $_GET['b'];

  $stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid WHERE blogid=?');
  $stmt->execute([$id]);
  $posts = $stmt->fetchAll();

  foreach ($posts as $blogpost) {
    $blog_id = $blogpost['blogid'];
    $blog_title = $blogpost['blogtitle'];
    $blog_content = $blogpost['blogcontent'];
    $blog_date = strtotime($blogpost['blogdate']);
    $blog_author = $blogpost['username'];


    echo "<strong>",$blog_title,"</strong><br>";
    echo $blog_content,"<br>";
    echo date('d/m/Y', $blog_date),"<br>";
    echo $blog_author;

  }
}
elseif (isset($_GET['t'])) {

  $tag = $_GET['t'];

  $stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.username, user.userid, tag_map.blogid, tag_map.tagid, test_tags.tagid, test_tags.tag FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid INNER JOIN tag_map ON blog_posts.blogid=tag_map.blogid INNER JOIN test_tags ON tag_map.tagid=test_tags.tagid WHERE test_tags.tag LIKE ? ');
  $stmt->execute([$tag]);
  $posts = $stmt->fetchAll();

  foreach ($posts as $blogpost) {
    $blog_id = $blogpost['blogid'];
    $blog_title = $blogpost['blogtitle'];
    $blog_content = $blogpost['blogcontent'];
    $blog_date = strtotime($blogpost['blogdate']);
    $blog_author = $blogpost['username'];


    echo "<strong>",$blog_title,"</strong><br>";
    echo $blog_content,"<br>";
    echo date('d/m/Y', $blog_date),"<br>";
    echo $blog_author;

  }
}
elseif (isset($_GET['a'])) {

  $author = $_GET['a'];

  $stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid WHERE user.username=?');
  $stmt->execute([$author]);
  $posts = $stmt->fetchAll();

  foreach ($posts as $blogpost) {
    $blog_id = $blogpost['blogid'];
    $blog_title = $blogpost['blogtitle'];
    $blog_content = $blogpost['blogcontent'];
    $blog_date = strtotime($blogpost['blogdate']);
    $blog_author = $blogpost['username'];


    echo "<strong>",$blog_title,"</strong><br>";
    echo $blog_content,"<br>";
    echo date('d/m/Y', $blog_date),"<br>";
    echo $blog_author;

  }
}
elseif (isset($_GET['d'])) {

  $year = $_GET['y'];
  $month = $_GET['m'];
  $day = $_GET['d'];

  $stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid WHERE YEAR (blog_posts.blogdate)=? AND MONTH (blog_posts.blogdate)=? AND DAY (blog_posts.blogdate)=?');
  $stmt->execute([$year,$month,$day]);
  $posts = $stmt->fetchAll();

  foreach ($posts as $blogpost) {
    $blog_id = $blogpost['blogid'];
    $blog_title = $blogpost['blogtitle'];
    $blog_content = $blogpost['blogcontent'];
    $blog_date = strtotime($blogpost['blogdate']);
    $blog_author = $blogpost['username'];


    echo "<strong>",$blog_title,"</strong><br>";
    echo $blog_content,"<br>";
    echo date('d/m/Y', $blog_date),"<br>";
    echo $blog_author;

  }
}
elseif (isset($_GET['m'])) {

  $year = $_GET['y'];
  $month = $_GET['m'];

  $stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid WHERE YEAR (blog_posts.blogdate)=? AND MONTH (blog_posts.blogdate)=?');
  $stmt->execute([$year,$month]);
  $posts = $stmt->fetchAll();

  foreach ($posts as $blogpost) {
    $blog_id = $blogpost['blogid'];
    $blog_title = $blogpost['blogtitle'];
    $blog_content = $blogpost['blogcontent'];
    $blog_date = strtotime($blogpost['blogdate']);
    $blog_author = $blogpost['username'];


    echo "<strong>",$blog_title,"</strong><br>";
    echo $blog_content,"<br>";
    echo date('d/m/Y', $blog_date),"<br>";
    echo $blog_author;

  }

}
elseif (isset($_GET['y'])) {

  $year = $_GET['y'];

  $stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid WHERE YEAR (blog_posts.blogdate)=?');
  $stmt->execute([$year]);
  $posts = $stmt->fetchAll();

  foreach ($posts as $blogpost) {
    $blog_id = $blogpost['blogid'];
    $blog_title = $blogpost['blogtitle'];
    $blog_content = $blogpost['blogcontent'];
    $blog_date = strtotime($blogpost['blogdate']);
    $blog_author = $blogpost['username'];


    echo "<strong>",$blog_title,"</strong><br>";
    echo $blog_content,"<br>";
    echo date('d/m/Y', $blog_date),"<br>";
    echo $blog_author;

  }
}



?>

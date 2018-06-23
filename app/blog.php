<?php

require_once 'db.php';
require_once '../includes/header.php';

if (isset($_GET['b'])){

  $id = $_GET['b'];

  $stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, blog_posts.comment_enable, user.username FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid WHERE blogid=?');
  $get_comments = $pdo->prepare('SELECT blog_posts.blogid, blog_comments.* FROM blog_posts INNER JOIN blog_comments ON blog_posts.blogid=blog_comments.blogid WHERE blog_posts.blogid=?');
  $stmt->execute([$id]);
  $posts = $stmt->fetchAll();

  foreach ($posts as $blogpost) {
    $blog_id = $blogpost['blogid'];
    $blog_title = $blogpost['blogtitle'];
    $blog_content = $blogpost['blogcontent'];
    $blog_date = strtotime($blogpost['blogdate']);
    $blog_author = $blogpost['username'];
    $blog_enabled_comments = $blogpost['comment_enable'];

    echo "<strong>",$blog_title,"</strong><br>";
    echo $blog_content,"<br>";
    echo date('d/m/Y', $blog_date),"<br>";
    echo $blog_author;

    if($blog_enabled_comments == 1){
      include 'comment_form.php';
      $get_comments->execute([$id]);
      $comments = $get_comments->fetchAll();

      foreach($comments as $blogcomment){
        $comment_email = $blogcomment['commentemail'];
        $comment_name = $blogcomment['commentname'];
        $comment = $blogcomment['comment'];
        $comment_id = $blogcomment['commentid'];

        echo $comment_name,"<br>";
        echo $comment_email,"<br>";
        echo $comment,"<br>";
        //echo $comment_id,"<br>";

      }

    } elseif($blog_enabled_comments == 0){
      echo "Comments Disabled";
    }
  }
}
elseif (isset($_GET['t'])) {

  $tag = $_GET['t'];

  $stmt = $pdo->prepare('SELECT blog_posts.blogid, blog_posts.userid, blog_posts.blogtitle, blog_posts.blogcontent, blog_posts.blogdate, blog_posts.comment_enable, user.username, user.userid, tag_map.blogid, tag_map.tagid, test_tags.tagid, test_tags.tag FROM blog_posts INNER JOIN user ON blog_posts.userid=user.userid INNER JOIN tag_map ON blog_posts.blogid=tag_map.blogid INNER JOIN test_tags ON tag_map.tagid=test_tags.tagid WHERE test_tags.tag LIKE ? ');
  $stmt->execute([$tag]);
  $posts = $stmt->fetchAll();

  foreach ($posts as $blogpost) {
    $blog_id = $blogpost['blogid'];
    $blog_title = $blogpost['blogtitle'];
    $blog_content = $blogpost['blogcontent'];
    $blog_date = strtotime($blogpost['blogdate']);
    $blog_author = $blogpost['username'];
    $blog_enabled_comments = $blogpost['comment_enable'];

    echo "<strong>",$blog_title,"</strong><br>";
    echo $blog_content,"<br>";
    echo date('d/m/Y', $blog_date),"<br>";
    echo $blog_author;

    if($blog_enabled_comments == 1){
      echo "Comments:";
    }

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

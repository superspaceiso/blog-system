<h1>New Post</h1>
<form role="form" action="./app/postblog.php" method="post">
  <input name="title" rows="8" cols="80"></input><br>
  <textarea name="content" rows="8" cols="80"></textarea><br>
  <button type="submit">Post</button>
</form>
<h1>Previous Posts</h1>
<?php require './app/bloglist.php'; ?>

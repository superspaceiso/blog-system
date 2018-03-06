<?php

session_start();

if (!isset($_SESSION["username"])) {
header('Location: login.php');
}

?>

<a href="./app/logoutscript.php">Log Out</a>

<h1>New Post</h1>
<form role="form" action="./app/postblog.php" method="post">
  <input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">
  <input type="text" name="title" rows="8" cols="80"></input><br>
  <textarea name="content" rows="8" cols="80"></textarea><br>
  <button type="submit" name="submit">Post</button>
</form>

<h1>Previous Posts</h1>
<?php require './app/bloglist.php'; ?>

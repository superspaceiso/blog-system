<?php

require_once "./includes/header.php";

session_start();

if (!isset($_SESSION["username"])) {
header('Location: login.php');
}

?>

<a href="./app/logoutscript.php">Log Out</a>

<div class="row">
  <div class="tweleve columns">

<h1>New Post</h1>
<form role="form" action="./app/postblog.php" method="post">
  <input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">
  <input class="u-full-width" type="text" name="title" placeholder="Title"></input><br>
  <textarea class="u-full-width" name="content" placeholder="Content"></textarea><br>
  <input  class="u-full-width" type="text" name="tags" placeholder="Tags, seperate using a comma eg Eggs,Milk,Flour"></input><br>
  <button class="button-primary" type="submit" name="submit">Post</button>
</form>

  </div>
</div>
<div class="row">
<div class="tweleve columns">
<h1>Previous Posts</h1>
<?php require './app/bloglist.php'; ?>

</div>
</div>

<?php require_once "./includes/footer.php" ?>

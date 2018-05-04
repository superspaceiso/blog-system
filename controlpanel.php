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
  <form id="contentform" method="post">
    <input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>"></input>
    <input class="u-full-width" type="text" name="title" placeholder="Title"></input><br>
    <textarea class="u-full-width" name="content" placeholder="Content"></textarea><br>
    <input  class="u-full-width" type="text" name="tags" placeholder="Tags, seperate using a comma eg Eggs,Milk,Flour"></input><br>
    <button class="button-primary">Post</button>
  </form>

  </div>
</div>

<div class="row">
  <div id="alert"></div>
</div>

<div class="row">
<div class="tweleve columns" id="postlist">
<h1>Previous Posts</h1>
<?php require './app/bloglist.php'; ?>

</div>
</div>

<script>
  $(document).ready(function(){
    $("#contentform").submit(function(){
      event.preventDefault();
      $.post("./app/postblog.php", $("#contentform").serialize(), function(data){
        $("#alert").text("Posted");
        $("#alert").css({"display":"block","background-color":"green","border":"3px solid darkgreen"});
        $('#alert').delay(1000).fadeOut('slow');
        $("#contentform")[0].reset();
        setTimeout(function(){location.reload()},2000);
      });
    });
    $(".delete").click(function(){
      event.preventDefault();
      var id = $(this).attr("id");
      $.post("./app/deleteblog.php",{"b":id}, function(data){
        $("#alert").text("Deleted");
        $("#alert").css({"display":"block","background-color":"red","border":"3px solid darkred"});
        $('#alert').delay(1000).fadeOut('slow');
        setTimeout(function(){location.reload()},2000);
    });
  });
});
</script>

<?php require_once "./includes/footer.php" ?>

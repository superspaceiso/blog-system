<form id="commentform" method="post">
  <input type="hidden" name="comment_blog" value="<?php echo $_GET["b"]; ?>"></input>
  <input type="text" name="comment_email" placeholder="Email Address"></input><br>
  <input type="text" name="comment_name" placeholder="Name"></input><br>
  <textarea class="u-full-width" name="comment_msg" placeholder="Comment"></textarea><br>
  <button class="button-primary">Post</button>
</form>

<script>
  $(document).ready(function(){
    $("#commentform").submit(function(){
      event.preventDefault();
      $.post("../app/post_comment.php", $("#commentform").serialize(), function(data){
        $("#commentform")[0].reset();
        setTimeout(function(){location.reload()},2000);
      });
    });
  });
</script>

<?php require_once "./includes/header.php" ?>

<div class="row">
  <div class="tweleve columns">

    <form id="login" role="form" method="post">
      <input name="username" type="text"  placeholder="Username"></input><br>
      <input name="password" type="password" placeholder="Password"></textarea><br>
      <button class="button-primary" type="submit">Log In</button>
    </form>

  </div>
</div>

<div id="alert"></div>

<script>
$(document).ready(function(){
  $("#login").submit(function(){
    event.preventDefault();
    $.post("./app/loginscript.php", $("#login").serialize())
      .done(function(data){
      $("#alert").text("Logging In");
      $("#alert").css({"display":"block","background-color":"green","border":"3px solid darkgreen"});
      $('#alert').delay(1000).fadeOut('slow');
      setTimeout(function(){window.location.href = "./controlpanel.php"},2000);
    });
  });
});
</script>

<?php require_once "./includes/footer.php" ?>

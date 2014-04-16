<?php
session_start();
require_once "../database/init.php";

// Check login
if (isset($_POST['login']) && $_POST['login'] == 'Login') {

  // check user with the salt

  $salt_stmt = $db->prepare('SELECT salt FROM users WHERE email=:email');
  $salt_stmt->execute(array(':email' => $_POST['email']));
  $res = $salt_stmt->fetch();
  $salt = ($res) ? $res->salt : '';
  $salted = hash('sha256', $salt . $_POST['pass']);


  $login_stmt = $db->prepare('SELECT email, user_id FROM users WHERE email=:email AND password=:pass');
  $login_stmt->execute(array(':email' => $_POST['email'], ':pass' => $salted));
  
  
  if ($user = $login_stmt->fetch()) {
    $_SESSION['email'] = $user->email;
    $_SESSION['user_id'] = $user->user_id;
  }
  else {
    $err = 'Incorrect email or password.';
  }
}

if (isset($_SESSION['email'])) {
  header("Location: profile.php");
}

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Teem</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/index.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300' rel='stylesheet' type='text/css'>  </head>
  <body>
  <div id='wrapper'>
 
    <!-- Desktop Slider -->
    <div id = "fullwidthindexdiv" class="text-center">
      <center><h1 class = "indexhead">Teem</h1>
        <h4 class = "indexsub">Schedule a meeting, divvy up tasks, and get together.</h4><center>
      </div>
 
    <!-- End Desktop  -->
    <br><br>
    <div class="row">
      <div class="large-12 columns">
        <div class="row">
 
    <!-- Thumbnails -->
         <div class="large-4 columns">
          <p> </p>
        </div>
        <div class="large-2 columns">
          <a href="createaccount.php" class="button expand">Sign Up</a>
        </div>
 
        <div class="large-2 columns">
          <a id="showLogin" href="#" data-reveal-id="myModal" class="button expand" data-reveal>Log In</a>
          <div id="myModal" class="reveal-modal small" data-reveal>
            <div id="login">
              <h1>Login</h1>
              <?php if (isset($err)) echo "<p>$err</p>" ?>
              <form method="post" action="index.php">
                <label for="email">Email: </label><input type="text" name="email" />
                <label for="pass">Password: </label><input type="password" name="pass" />
                <input name="login" type="submit" value="Login" />
              </form>
            </div>
            <a class="close-reveal-modal">&#215;</a>
          </div>
        </div>
         <div class="large-4 columns">
          <p> </p>
        </div>
    <!-- End Thumbnails -->
      </div>
    </div>
  </div>
 
  <div class="row"> 
    <!-- Content -->
    <div class="large-12 columns">
      <center><p><br>New to Teem? Learn more <a href="about.php" taget="_blank" >about us</a>.</p></center>
    </div>
 
    <!-- End Content -->
 
      </div>
 

   <!--end wrapper-->
   </div>
 
    <!-- Footer -->
    <script type="text/javascript" src="js/foundation/foundation.js"></script>
    <script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
    <script>
    $(document).foundation();
    </script>

</body>
</html>
<?php

  require_once "./bottomNav.php";

?>
    

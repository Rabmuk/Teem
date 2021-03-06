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

  //login statement
  $login_stmt = $db->prepare('SELECT email, user_id FROM users WHERE email=:email AND password=:pass');
  $login_stmt->execute(array(':email' => $_POST['email'], ':pass' => $salted));
  
  //log in if username and password are correct
  if ($user = $login_stmt->fetch()) {
    $_SESSION['email'] = $user->email;
    $_SESSION['user_id'] = $user->user_id;
  }
  else {
   //if they're incorrect, let the user know
    $err = 'Incorrect email or password.';
  }
}

// creates user based on session variables
if (isset($_SESSION['email'])) {
  header("Location: profile.php");
}

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <!--links to outside files-->
    <meta charset="utf-8" />
    <title>Teem</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/index.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300' rel='stylesheet' type='text/css'>  </head>
  <body>
  <div id='wrapper'>
 
    <!--start desktop-->
    <div id = "fullwidthindexdiv" class="text-center">
      <center>
        <!--logo, Teem name, tagline-->
        <img src="img/logo-large.png" />
        <h1 class = "indexhead">Teem</h1>
        <h4 class = "indexsub">Be more organized and productive during your meetings.</h4>
        <center>
      </div>
 
    <!-- End Desktop  -->

    <br><br>
    <div class="row">
      <div class="large-12 columns">
          <?php if (isset($err)) {
            //notify user of error
            echo "<div class='row'><div class='large-12 columns text-center'><p class='error'> Invalid Username or Password</p></div></div>";

          }
          ?>
        <div class="row">
 
        <!--begin button options to create an account or sign in-->
         <div class="large-4 columns">
          <p> </p>
        </div>
        <div class="large-2 columns">
          <!--create account-->
          <a href="createaccount.php" class="button expand">Sign Up</a>
        </div>
        <!--sign in dropdown button-->
        <div class="large-2 columns">
          <a href="#" data-reveal-id="myModal" class="button expand" data-reveal>Log In</a>
          <!--dropdown after clicking log in button-->
          <div id="myModal" class="reveal-modal small" data-reveal>
            <div id="login">
              <h1>Login</h1>
              <form method="post" action="index.php">
                <!--enter email-->
                <label for="email">Email: </label><input id="email" type="text" class="error" name="email" />

                <!--enter password-->
                <label for="pass">Password: </label><input id="password" type="password" name="pass" />

                <!--subit button-->
                <input name="login" type="submit" value="Login" />
              </form>
            </div>
            <!--end dropdown thing-->
            <a class="close-reveal-modal">&#215;</a>
          </div>
        </div>
         <div class="large-4 columns">
          <p> </p>
        </div>
    <!-- End button options to ceate acocunt or sign in -->
      </div>
    </div>
  </div>
 
  <div class="row"> 
    <!-- learn more, link ot about page -->
    <div class="large-12 columns">
      <center><p><br>New to Teem? Learn more <a href="about.php" taget="_blank" >about us</a>.</p></center>
    </div>
 
  </div>
 

   <!--end wrapper-->
   </div>
 
    <!-- links to javascript -->
    <script type="text/javascript" src="js/foundation/foundation.js"></script>
    <script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
    <script>
    $(document).foundation();
    </script>

</body>
</html>
<!--footer, yo-->
<?php

  require_once "./bottomNav.php";

?>
    

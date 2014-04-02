<?php 
require_once "../database/init.php"; 
require_once "classes/user.php";
?>

<?php 

  if (isset($_POST['register']) && $_POST['register'] == "Register") {
    $uniqueEmail = $db->prepare('SELECT email FROM users WHERE email=:email');
    $uniqueEmail->execute(array(':email' => $_POST['email']));
    $res = $uniqueEmail->fetch();
    if(!$res){ //if the email is not found in the database
      //check if fields are filled
      if (!isset($_POST['email']) || !isset($_POST['pass']) || !isset($_POST['passconfirm']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['passconfirm'])) {
        $msg = "Please fill in all form fields.";
      }else if($_POST['pass'] !== $_POST['passconfirm'] ){
        $msg = "Passwords must match";
      }else{
        // Generate random salt
        $salt = hash('sha256', uniqid(mt_rand(), true));      

        // Apply salt before hashing
        $salted = hash('sha256', $salt . $_POST['pass']);
        
        // Store the salt with the password, so we can apply it again and check the result
        // $stmt = $db->prepare("INSERT INTO users (email, password, salt) VALUES (:email, :pass, :salt)");
        // $stmt->execute(array(':email' => $_POST['email'], ':pass' => $salted, ':salt' => $salt));
        addUserToDatabase($_POST['email'], $salted, $salt, "", "");
        $msg = "Account created.";
      }
    }else{
      $msg = "That email is already in use";
    }
  }

?>

<!doctype html>

<?php
    require_once "./headerNav.php";
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create an account</title>
        <link rel="stylesheet" href="css/foundation.css">
        <link rel="stylesheet" href="css/createaccount.css">

    </head>
    <body>

        <row class="large-9 push-3 columns">
          <!-- Left panel with cute intro sentence -->
          <div class="large-6 columns" id="leftSide">
            <div id="introSentence">
              <h1>We want your agendas to be as DYNAMIC as your meetings.</h1>
            </div>
            <br>
            <h2>Create an account today!</h2>
          </div>

         <!--  Right side form -->
          <div class ="large-6 columns"> 
            <form>
              

              <div class="row">
                <div class ="large-6 columns">
                  <label>First name
                    <input type="text" placeholder="First name" />
                  </label>
                </div>
              </div>

              <div class="row">
                <div class ="large-6 columns">
                  <label>Last name
                    <input type="text" placeholder="Last name" />
                  </label>
                </div>
              </div>

              <div class="row">
                <div class ="large-6 columns">
                  <label>Email
                    <input type="text" placeholder="Email" />
                  </label>
                </div>
              </div>

              <div class="row">
                <div class ="large-6 columns">
                  <label>Password
                    <input type="password" placeholder="Password" />
                  </label>
                </div>
              </div>

              <div class="row">
                <div class ="large-6 columns">
                  <label>Confirm password
                    <input type="password" placeholder="Confirm password" />
                  </label>
                </div>
              </div>
              <a href="#" class="button">Submit</a>
            </form>

            
          </div> 
        </row>
    </body>
</html>

<?php

  require_once "./bottomNav.php";

?>
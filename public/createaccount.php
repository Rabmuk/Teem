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
  
        $user = addUserToDatabase($_POST['email'], $salted, $salt, $_POST['fName'], $_POST['lName']);
        if ($user->exists()) {
          $msg = 'Account created! Login <a href="index.php">here</a>';  
        }
        else{
          $msg = 'An error has occured, please try again.';   
        }
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

        <title>Teem - Create an account</title>

    <body>
      <div id="wrapper">
        <!-- Entire page fits same sizing as rest of website -->
        <div class="row">

          <!-- Left panel with cute intro sentence -->
          <div class="large-6 columns" id="leftSide">
            <div id="introSentence">
              <br>
              <!-- Sorry for the inline styling, but I wanted it to be a diferent color. -->
              <h1>
              <?php if (isset($msg)) {
                echo $msg;  
              }else{
               echo 'We want your agendas to be as <span style="color:#197b5e;">DYNAMIC</span> as your meetings.';
               echo '<h2>Create an account today!</h2>';
              }

              ?>
              </h1>
          </div>
            <!-- Line spacing between the two sentences -->
        
          </div>

         <!--  Right side form -->
          <div class ="large-6 columns"> 
            <form method="post" action="createaccount.php">
              <!-- First name input -->
              <div class="row">
                <div class ="large-6 columns">
                  <label>First name
                    <input type="text" placeholder="First name" name="fName" />
                  </label>
                </div>
              </div>
              <!-- Last name input -->
              <div class="row">
                <div class ="large-6 columns">
                  <label>Last name
                    <input type="text" placeholder="Last name" name="lName" />
                  </label>
                </div>
              </div>
              <!-- Email address -->
              <div class="row">
                <div class ="large-6 columns">
                  <label>Email
                    <input type="email" placeholder="Email" name="email" />
                  </label>
                </div>
              </div>
              <!-- Password -->
              <div class="row">
                <div class ="large-6 columns">
                  <label>Password
                    <input type="password" placeholder="Password" name="pass" />
                  </label>
                </div>
              </div>
              <!-- Confirm password -->
              <div class="row">
                <div class ="large-6 columns">
                  <label>Confirm password
                    <input type="password" placeholder="Confirm password" name="passconfirm" />
                  </label>
                </div>
              </div>
              <input type="submit" name="register" value="Register" />
            </form>
          </div> 
        </row>
        </div>
      </div>

    </body>
</html>

<?php

  require_once "./bottomNav.php";

?>
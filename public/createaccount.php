<?php require_once "../database/init.php"; ?>

<?php 

  if (isset($_POST['register']) && $_POST['register'] == "Register") {
    $uniqueEmail = $db->prepare('SELECT email FROM users WHERE email=:email');
    $uniqueEmail->execute(array(':email' => $_POST['email']));
    $res = $uniqueEmail->fetch();
    if(!$res){ //if the email is not found in the database
      //check if fields are filled
      if (!isset($_POST['email']) || !isset($_POST['pass']) || !isset($_POST['passconfirm']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['passconfirm'])) {
        $msg = "Please fill in all form fields.";
      }

    }else{
      $msg = "That email is already in use";
    }
  }

?>

<html>
<head>
  <title>make your acc</title>
</head>
<body>
  <form method="post" action="createaccount.php">
    <label for="email">Email: </label><input type="text" name="email" />
    <label for="pass">Password: </label><input type="password" name="pass" />
    <label for="passconfirm">Confirm: </label><input type="password" name="passconfirm" />
    <input type="submit" name="register" value="Register" />
  </form>
</body>
</html>
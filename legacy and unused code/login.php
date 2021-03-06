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

if (isset($_SESSION['email'])){
    header("Location: ./profile.php");
}

?>

<!doctype html>
<html>
<head>
  <title>Teem - Login</title>
</head>
<body>
  <h1>Login</h1>
  <?php if (isset($err)) echo "<p>$err</p>" ?>
  <form method="post" action="login.php">
    <label for="email">Email: </label><input type="text" name="email" />
    <label for="pass">Password: </label><input type="password" name="pass" />
    <input name="login" type="submit" value="Login" />
  </form>
</body>
</html>

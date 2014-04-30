<!-- This is the header navigation for pages when a user is logged in. --> 
<<<<<<< HEAD

  <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/foundation.css" />

<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300' rel='stylesheet' type='text/css'>  </head>
=======
<!doctype html>
<html>
    <head>
      <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300' rel='stylesheet' type='text/css'>   
      <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300' rel='stylesheet' type='text/css'>
      <!--CSS LINKS-->
      <link rel="stylesheet" href="css/accountsettings.css" />
      <link rel="stylesheet" href="css/agenda.css" />
      <link rel="stylesheet" href="css/colorscheme.css" />
      <link rel="stylesheet" href="css/createaccount.css" />
      <link rel="stylesheet" href="css/createagenda.css" />
      <link rel="stylesheet" href="css/createmeeting.css" />
      <link rel="stylesheet" href="css/editgroup.css" />
      <link rel="stylesheet" href="css/foundation.css" />
      <link rel="stylesheet" href="css/foundation.min.css" />
      <link rel="stylesheet" href="css/foundation-datepicker.css" />
      <link rel="stylesheet" href="css/index.css" />
      <link rel="stylesheet" href="css/foundation.css" />
    </head>
>>>>>>> d89657c99ff8d41e616a21e7b7512ab281b72ff7
   <div class="row header">
    <div class="large-3 columns">
      
      <a id="logo" href="index.php"><img src="img/logo-mini.png" />Teem</a>
    </div>
    
    <div class="large-9 columns">
      <ul class="inline-list right" id = "headerlist">
        <li><a href="profile.php">Home</a></li>
        <li><a href="accountsettings.php">Settings</a></li>
        <?php if(isset($_SESSION['email'])){ ?>
          <li><a href="logout.php">Log Out</a></li>
        <?php }else{ ?>
          <li><a href="login.php">Log In</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
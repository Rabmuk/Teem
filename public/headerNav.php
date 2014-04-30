<!-- This is the header navigation for pages when a user is logged in. --> 
<!doctype html>
<html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--Fonts-->
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
      <link rel="stylesheet" href="css/normalize.css" />
      <link rel="stylesheet" href="css/profile.css" />
      <!--JAVASCRIPT HELPERS-->
      <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
      <script src="js/agenda.js" type="text/javascript"></script>  
      <script src="js/contactscripts.js" type="text/javascript"></script>  
      <script src="js/createagenda.js" type="text/javascript"></script>  
      <script src="js/createmeeting.js" type="text/javascript"></script>  
      <script src="js/foundation.min.js" type="text/javascript"></script>  
      <script src="js/foundation-datapicker.js" type="text/javascript"></script>  
      <script src="js/index.js" type="text/javascript"></script>  
      <script src="js/jquery.tubular.1.0.js" type="text/javascript"></script>  

    </head>
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
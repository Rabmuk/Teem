<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700' rel='stylesheet' type='text/css'>


<!-- This is the header navigation for pages when a user is logged in. --> 
<?php // session_start(); ?>
   <div class="row header">
    <div class="large-3 columns">
      <h1><img src="http://placehold.it/400x75&text=Logo" /></h1>
    </div>
    
    <div class="large-9 columns">
      <ul class="inline-list right">
        <li><a href="index.php">Home</a></li>
        <li><a href="accountsettings.php">Settings</a></li>
        <?php if(isset($_SESSION['email'])){ ?>
          <li><a href="logout.php">Log Out</a></li>
        <?php }else{ ?>
          <li><a href="login.php">Log In</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  
 
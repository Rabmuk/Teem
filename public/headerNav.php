<!-- This is the header navigation for pages when a user is logged in. --> 


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
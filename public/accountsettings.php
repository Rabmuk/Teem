<?php 
	
	require_once "./headerNav.php";

?>
<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
    <title>Account Settings</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/accountsettings.css"/>
</head>
<body>
	<div id="wrapper">
		<div class="row">
			<div class="large-12">
				<h1>General Settings</h1>
			</div>
		</div>
		<form>
		  <div class="row">
		    <div class="small-8">
		      <div class="row">
		        <div class="small-3 columns">
		          <label for="firstName" class="right inline">First Name</label>
		        </div>
		        <div class="small-9 columns">
		          <input type="text" id="firstName" placeholder="Enter First Name">
		        </div>
		      </div>
		      <div class="row">
		        <div class="small-3 columns">
		          <label for="lastName" class="right inline">Last Name</label>
		        </div>
		        <div class="small-9 columns">
		          <input type="text" id="lastName" placeholder="Enter Last Name">
		        </div>
		      </div>
		      <div class="row">
		        <div class="small-3 columns">
		          <label for="email" class="right inline">E-mail</label>
		        </div>
		        <div class="small-9 columns">
		          <input type="email" id="email" placeholder="Enter E-mail">
		        </div>
		     </div>
		     <div class="row">
		        <div class="small-3 columns">
		          <label for="school" class="right inline">School</label>
		        </div>
		        <div class="small-9 columns">
		          <input type="text" id="school" placeholder="Enter School">
		        </div>
		     </div>
		     <div class="row">
		        <div class="small-3 columns">
		          <label for="company" class="right inline">Company</label>
		        </div>
		        <div class="small-9 columns">
		          <input type="text" id="company" placeholder="Enter company">
		        </div>
		     </div>
		     <div class="row">
		        <div class="small-3 columns"></div>
		        <div class="small-9 columns">
		          <input id="deleteAcc" type="checkbox"><label for="deleteAcc">Delete Account?</label></input>
		        </div>
		     </div>
		     <div class="row">
		     		<div class="small-9 columns"></div>
		     		<div class="small-3 columns">
		     			<input type="submit" class="button small expand"></input>
		     		</div>
		     </div>
		    </div>
		  </div>
		</form>
	</div>
</body>
</html>
<?php

	require_once "./bottomNav.php";

?>


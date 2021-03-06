<?php 

session_start();
foreach (glob("classes/*.php") as $filename) // incluces all support files from classes
{
	include $filename;
}

if (isset($_SESSION['email'])){
	$user = new User($_SESSION['email']); // checks if user is logged in
}else{
	header("Location: ./index.php"); // sends them to home page if not logged in
}

if (isset($_POST['submit']) && $_POST['submit'] == "Submit") { // when they click submit
	if (isset($_POST['deleteAcc'])) { // checks if they checked delete account
		$user->deleteUser();
		header("Location: ./logout.php"); // deletes account and logs out
	}
	if (isset($_POST['firstName']) && $_POST['firstName'] != "Enter First Name") {
		$user->setFirstName($_POST['firstName']); // changes first name
	}

	if (isset($_POST['lastName']) && $_POST['lastName'] != "Enter Last Name") {
		$user->setLastName($_POST['lastName']); // changes last name
	}

	if (isset($_POST['email']) && $_POST['email'] != "Enter E-mail") {
		$user->setEmail($_POST['email']);
		$_SESSION['email'] = $_POST['email']; // changes email
	}

	echo '<script>window.location.reload()</script>'; // reloads page
}

require_once "./headerNav.php"; // include header

?>


<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<title>Account Settings</title>
	<link rel="stylesheet" type="text/css" href="css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="css/accountsettings.css"/>
</head>
<body>
	<!-- make sticky footer !-->
	<div id = "specialwrapper"> 
		<div class="row">
			<div class="large-12">
				<h1>General Settings</h1>
			</div>
		</div>
		<!-- Change user info form !-->
		<form action="" method="post">
			<div class="row">
				<div class="small-8">
					<div class="row">
						<div class="small-3 columns">
							<label for="firstName" class="right inline">First Name</label>
						</div>
						<div class="small-9 columns">
							<input type="text" id="firstName" name="firstName" value="<?php echo $user->getFirstName(); ?>">
						</div>
					</div>
					<div class="row">
						<div class="small-3 columns">
							<label for="lastName" class="right inline">Last Name</label>
						</div>
						<div class="small-9 columns">
							<input type="text" id="lastName" name="lastName" value="<?php echo $user->getLastName(); ?>">
						</div>
					</div>
					<div class="row">
						<div class="small-3 columns">
							<label for="email" class="right inline">E-mail</label>
						</div>
						<div class="small-9 columns">
							<input type="email" id="email" name="email" value="<?php echo $user->getEmail(); ?>">
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
						<!-- Shift delete account over !-->
						<div class="small-3 columns"></div>
						<div class="small-9 columns">
							<!-- Checkbox for delete account !-->
							<input id="deleteAcc" name="deleteAcc" type="checkbox"><label for="deleteAcc">Delete Account?</label></input>
						</div>
					</div>
					<div class="row">
						<div class="small-9 columns"></div>
						<div class="small-3 columns">
							<!-- Sbumit button !-->
							<input type="submit" name="submit" value="Submit" class="button expand"></input>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>
</html>


<?php

require_once "./bottomNav.php"; // include footer

?>


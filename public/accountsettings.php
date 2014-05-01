<?php 

session_start();
foreach (glob("classes/*.php") as $filename)
{
	include $filename;
}

if (isset($_SESSION['email'])){
	$user = new User($_SESSION['email']);
}else{
	header("Location: ./index.php");
}

if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
	if (isset($_POST['deleteAcc'])) {
		$user->deleteUser();
		header("Location: ./logout.php");
	}
	if (isset($_POST['firstName']) && $_POST['firstName'] != "Enter First Name") {
		$user->setFirstName($_POST['firstName']);
	}

	if (isset($_POST['lastName']) && $_POST['lastName'] != "Enter Last Name") {
		$user->setLastName($_POST['lastName']);
	}

	if (isset($_POST['email']) && $_POST['email'] != "Enter E-mail") {
		$user->setEmail($_POST['email']);
		$_SESSION['email'] = $_POST['email'];
	}

	echo '<script>window.location.reload()</script>';
}

require_once "./headerNav.php"; 

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
	<div id = "specialwrapper">
		<div class="row">
			<div class="large-12">
				<h1>General Settings</h1>
			</div>
		</div>
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
<!-- 					<div class="row">
						<div class="small-3 columns"></div>
						<div class="small-9 columns">
							<input id="deleteAcc" name="deleteAcc" type="checkbox"><label for="deleteAcc">Delete Account?</label></input>
						</div>
					</div> -->
					<div class="row">
					        <div class="large-8 columns"><p></p></div>
					        <div class="large-2 columns">
					          <a href="#" data-reveal-id="myModal" class="button expand" data-reveal>Delete Group</a>
					        </div>
					        <div class="large-2 columns">
					          <input type="submit" name="submit" value="Submit" class="button small expand"></input>
					        </div>
					</div>
					</form>
					<div id='myModal' class='reveal-modal small' data-reveal>
				        <p class="text-center">Are you sure you want to delete your account?</p>
				        <div class="row">
				          <div class="large-3 columns"><p></p></div>
				          <form method="post">
				          <div class="large-3 columns">
				            <input type="submit" name="submit" value="Yes" class="button expand"></input>
				          </div>
				          <div class="large-3 columns">
				            <input type="submit" name="submit" value="No" class="button expand"></input>
				          </div>
				          <div class="large-3 columns"><p></p></div>
				        </div>
				        </form>
				        <a class="close-reveal-modal">&#215;</a>
				      </div>
				  </div>
			</div>
		
	</div>
</body>
</html>


<?php

require_once "./bottomNav.php";

?>


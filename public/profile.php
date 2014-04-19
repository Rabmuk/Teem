<?php 	
session_start();
require_once "classes/user.php";
require_once "classes/group.php";

if (isset($_SESSION['email'])){
	$user = new User($_SESSION['email']);
}else{
	header("Location: ./index.php");
}

require_once "./headerNav.php";	
?>
<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<title>My Profile - Home</title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/profile.css" />
</head>
<body>
	<div>
		<div class="row">
			<div class="large-6 columns">
				<h1 class="myProfile">Welcome, <?php echo $user->getFirstName(); ?>!</h1>
			</div>
			<div class="large-3 columns">
				<a href="creategroup.php">(+) Create a Group</a>
			</div>
			<div class="large-3 columns">
				<a href="createmeeting.php">(+) Create a Meeting</a>
			</div>
		</div>
		<div class="row">
			<div class="large-6 columns">
				<div class="boxcolumn">
					<h2 class="profileHeader">My Groups</h2>
					<?php 
					$results = $user->getGroups();
					foreach ($results as $group) {
						?>
						<h3 class="teamTitle"> <?php echo $group->getName(); ?> </h3>
						<ul id="groupNames">
							<li>Team Leader: <?php echo $group->getOwner()->getName(); ?></li>
							<li>Members: 
								<?php 
									echo $group->getMemberNames();
								?>
							</li>
							</ul>
							<hr class="profileDivide"></hr>
							<?php
						}
						?>
						<!-- Insert groups here! -->

					<!-- <h3 class="teamTitle">SnapchatRoullette</h3>
					<ul id="groupNames">
						<li>Team Leader: Not Chris</li>
						<li>Members: Lauren, Hayley, Alex, Candice, Josh
					</ul>
					<hr class="profileDivide"></hr> -->
				</div>
			</div>
			<div class="large-6 columns">
				<div class="boxcolumn">
					<h2 class="profileHeader">Upcoming Meetings</h2>
					<h3 class="teamTitle">Wednesay, March 26th</h3>
					<div class="row">
						<div class="large-2 columns">
							<img src="img/clock.png"></img>
						</div>
						<div class="large-10 columns">
							<h4>3:00 PM - SnapchatRoulette</h4>
						</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>
	<?php

	require_once "./bottomNav.php";

	?>


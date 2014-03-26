<?php 
	
	require_once "./headerNav.php";

?>
<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
    <title>My Profile - Home</title>
    <link rel="stylesheet" href="css/foundation.css" />
</head>
<body>
	<div>
		<div class="row">
			<div class="large-6 columns">
				<h1 class="myProfile">Welcome, User!</h1>
			</div>
			<div class="large-3 columns">
				<a href="#" class="button small expand">(+) Create a Group</a>
			</div>
			<div class="large-3 columns">
				<a href="#" class="button small expand">(+) Create a Meeting</a>
			</div>
		</div>
		<div class="row">
			<div class="large-6 columns">
				<div class="boxcolumn">
					<h2 class="profileHeader">My Groups</h2>
					<h3 class="teamTitle">SnapchatRoullette</h3>
					<ul id="groupNames">
						<li>Team Leader: Not Chris</li>
						<li>Members: Lauren, Hayley, Alex, Candice, Josh
					</ul>
					<hr class="profileDivide"></hr>
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
							<h3>3:00 PM - SnapChatRoulette</h3>
						</div>
			</div>
	</div>
</body>
</html>
<?php

	require_once "./bottomNav.php";

?>


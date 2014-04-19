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
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body>
	<div id="wrapper">
			<div class="row">
				<div class="large-6 columns">
					<h1 class="myProfile">Welcome, <?php echo $user->getFirstName(); ?>!</h1>
				</div>
				<div class="large-3 columns">
					<a href="#" data-reveal-id="myModal" data-reveal>(+) Create a Group</a>
					<div id="myModal" class="reveal-modal small" data-reveal>
            <div id="createGroup">
            	<h1>Create a Group</h1>
              <form method="post" action="profile.php" id="addGroup">
                <label for="groupName">Group Name: </label><input type="text" name="groupName" />
                <label for="addMembers">Add Members*:</label><textarea rows="4" cols="50" name="addMembers" form="addGroup"></textarea>
                <p>*Seperate group member e-mails by ','</p>
                <div class="row">
                	<div class="large-12 columns">
                		<input name="addMembers" type="submit" value="Submit" />
                	</div>
                </div>
              </form>
            </div>
            <a class="close-reveal-modal">&#215;</a>
          </div>
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
		</div>
	</body>
	<script type="text/javascript" src="js/foundation/foundation.js"></script>
  <script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
  <script>
  $(document).foundation();
  </script>
	</html>
	<?php

	require_once "./bottomNav.php";

	?>


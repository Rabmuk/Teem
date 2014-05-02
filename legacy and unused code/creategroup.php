<?php 
require_once "../database/init.php"; 
require_once "classes/user.php";
require_once "classes/meeting.php";
require_once "./headerNav.php";

?>

<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<title>Create a Group</title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/formsettings.css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="js/createmeeting.js" type="text/javascript" ></script>
</head>
<body>
	<div id = "wrapper">
		<div class="row">
			<div class="large-12">
				<h2>Create a Group</h2>
			</div>
		</div>
		<form method="post" action="creategroup.php">
			<div class="row">
				<div class="small-12 large-12 columns">
					<div class="row">
						<div class="small-3 columns">
							<label for="title" class="right inline">Title</label>
						</div>
						<div class="small-9 columns">
							<input type="text" id="title" name="title" placeholder="Enter Title">
						</div>
					</div>

					<div class="row">
						<div class="small-3 columns">
							<label for="description" class="right inline">Description</label>
						</div>
						<div class="small-9 columns">
							<textarea type="text" id="description" rows="2" placeholder="Enter Description"></textarea>
						</div>
					</div>

					<div class="row">
						<div class="small-3 large-3 columns">
							<label for="attendees" class="right inline">Members</label>
						</div>
						<div class="small-9 large-9 columns">
							<textarea type="text" id="attendees" name="attendees" rows="5" placeholder="Enter Members"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="small-9 large-6 small-centered large-centered columns">
							<!-- <input name="submit" type="submit" class="button nice small radius">Create</a> -->
							<input name="submit" type="submit" value="Create" class="button nice radius expand"/>
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

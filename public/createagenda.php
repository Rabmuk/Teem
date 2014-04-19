<?php 	require_once "./headerNav.php";	
?>
<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
    <title>My Profile - Home</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/createagenda.css" />
</head>
<body>
	<div>
		<div class="row">
			<div class="large-12 columns">
				<h1>Create Your Agenda</h1>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
			<form>
			Meeting name:<input type="text" name="firstname"><br>
			Desired outcomes:<input type="text" name="lastname">
			</form>
			<p>Topics of Discussion:</p>
			</div>
		</div>
		<!--labels-->
		<div class="row">
			<div class="large-1 columns">
				<p> </p>
			</div>
			<div class="large-3 columns">
				<p>Topic</p>
			</div>
			<div class="large-3 columns">
				<p>People responsible</p>
			</div>
			<div class="large-3 columns">
				<p>Duration</p>
			</div>
			<div class="large-2 columns">
				<p> </p>
			</div>
		</div>
		<!--form1-->
		<form>
			<div class="row">
				<div class="large-1 columns">
					<p>1)</p>
				</div>
				<div class="large-3 columns">
					<input type="text" name="topic" value="topic">
				</div>
				<div class="large-3 columns">
					<input type="text" name="people" value="people">
				</div>
				<div class="large-2 columns">
					<input type="text" name="duration" value="duration">
				</div>
				<div class="large-3 columns">
					<p> </p>
				</div>
			</div>
		</form>
		<!--form2-->
		<form>
			<div class="row">
				<div class="large-1 columns">
					<p>2)</p>
				</div>
				<div class="large-3 columns">
					<input type="text" name="topic" value="topic">
				</div>
				<div class="large-3 columns">
					<input type="text" name="people" value="people">
				</div>
				<div class="large-2 columns">
					<input type="text" name="duration" value="duration">
				</div>
				<div class="large-3 columns">
					<p> </p>
				</div>
			</div>
		</form>
		<!--form3-->
		<form>
			<div class="row">
				<div class="large-1 columns">
					<p>3)</p>
				</div>
				<div class="large-3 columns">
					<input type="text" name="topic" value="topic">
				</div>
				<div class="large-3 columns">
					<input type="text" name="people" value="people">
				</div>
				<div class="large-2 columns">
					<input type="text" name="duration" value="duration">
				</div>
				<div class="large-3 columns">
					<p> </p>
				</div>
			</div>
		</form>
		<!--add more-->
		<div class="row">
			<div class="large-1 columns"><p></p></div>
			<div class="large-11 columns">
				<a href="">(+) Add more</a>
				<br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>

</body>
</html>
<?php

	require_once "./bottomNav.php";

?>

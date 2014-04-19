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
	<div class="row">
		<div class="large-12 columns">
			<h1>Create your Agenda</h1>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<form>
				Meeting name:<input type="text" value="Make this take the meeting name and display it here" name="firstname"><br>
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
		<div class="large-4 columns">
			<p>Topic</p>
		</div>
		<div class="large-4 columns">
			<p>People responsible</p>
		</div>
		<div class="large-3 columns">
			<p>Duration</p>
		</div>
	</div>
	<!--form1-->
	<form>
		<div class="row">
			<div class="large-1 columns">
				<p>1)</p>
			</div>
			<div class="large-4 columns">
				<input type="text" name="topic" value="topic" onFocus="if(this.value=='topic')this.value='';">
			</div>
			<div class="large-4 columns">
				<input type="text" name="people" value="people" onFocus="if(this.value=='people')this.value='';">
			</div>
			<div class="large-1 columns">
				<input type="text" name="duration" value="#" onFocus="if(this.value=='#')this.value='';">
			</div>
			<div class="large-2 columns">
				<select>
				  <option>Minutes</option>
				  <option>Hours</option>
				</select>
			</div>
		</div>
	</form>
	<!--form2-->
	<form>
		<div class="row">
			<div class="large-1 columns">
				<p>2)</p>
			</div>
			<div class="large-4 columns">
				<input type="text" name="topic" value="topic" onFocus="if(this.value=='topic')this.value='';">
			</div>
			<div class="large-4 columns">
				<input type="text" name="people" value="people" onFocus="if(this.value=='people')this.value='';">
			</div>
			<div class="large-1 columns">
				<input type="text" name="duration" value="#" onFocus="if(this.value=='#')this.value='';">
			</div>
			<div class="large-2 columns">
				<select>
				  <option>Minutes</option>
				  <option>Hours</option>
				</select>
			</div>
		</div>
	</form>
	<!--form3-->
	<form>
		<div class="row">
			<div class="large-1 columns">
				<p>3)</p>
			</div>
			<div class="large-4 columns">
				<input type="text" name="topic" value="topic" onFocus="if(this.value=='topic')this.value='';">
			</div>
			<div class="large-4 columns">
				<input type="text" name="people" value="people" onFocus="if(this.value=='people')this.value='';">
			</div>
			<div class="large-1 columns">
				<input type="text" name="duration" value="#" onFocus="if(this.value=='#')this.value='';">
			</div>
			<div class="large-2 columns">
				<select>
				  <option>Minutes</option>
				  <option>Hours</option>
				</select>
			</div>
		</div>
	</form>
	<!--add more-->
	<div class="row">
		<div class="large-11 columns">
			<a href="">(+) Add more</a><br><br>
		</div>
	</div>
	<!--Submit button-->
	<br>
	<div class="row">
		<div class="large-2 columns">
			<button type="button">Done!</button>
		</div>
		<div class="large-7 columns">
			<p>*People can attach their own files and action items to customize their portions of the meeting once the agenda is created.</p>
		</div>
		<div class="large-3 columns"><p></p></div>
	</div>

<!--don't worry about this-->
<br><br><br><br><br>
</body>
</html>
<?php

	require_once "./bottomNav.php";

?>

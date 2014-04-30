<?php 	require_once "./headerNav.php";	
?>
<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
    <title>Create Agenda</title>
    <title>Teem - Create Agenda</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/createagenda.css" />
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/createagenda.js" type="text/javascript"></script>
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
				Meeting name:<input type="text" value="Make this take the meeting name and display it here" name="meetingname"><br>
				Desired outcomes:<input type="text" name="outcomes">
			</form>
			<p>Topics of Discussion:</p>
		</div>
	</div>
	<!--labels-->
	<div class="row">
		<div class="large-1 columns">
			<p></p>
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
	<form class="groupForm">
		<div class="row">
			<div class="large-1 columns">
				<p>1)</p>
			</div>
			<div class="large-4 columns">
				<input type="text" name="topic" value="Enter topic..." onFocus="if(this.value=='Enter topic...')this.value='';">
			</div>
			<div class="large-4 columns">
				<input type="text" name="people" value="Enter team members..." onFocus="if(this.value=='Enter team members...')this.value='';">
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
	<form class="groupForm">
		<div class="row">
			<div class="large-1 columns">
				<p>2)</p>
			</div>
			<div class="large-4 columns">
				<input type="text" name="topic" value="Enter topic..." onFocus="if(this.value=='Enter topic...')this.value='';">
			</div>
			<div class="large-4 columns">
				<input type="text" name="people" value="Enter team members..." onFocus="if(this.value'='Enter team members...')this.value='';">
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
	<form class="groupForm">
		<div class="row">
			<div class="large-1 columns">
				<p>3)</p>
			</div>
			<div class="large-4 columns">
				<input type="text" name="topic" value="Enter topic..." onFocus="if(this.value=='Enter topic...')this.value='';">
			</div>
			<div class="large-4 columns">
				<input type="text" name="people" value="Enter team members..." onFocus="if(this.value=='Enter team members...')this.value='';">
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
		<div class="large-2 columns">
			<a id="add" href="#">(+) Add</a>
		</div>
		<div class="large-10 columns">
			<a id="delete" href="#">(-) Delete Last</a>
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

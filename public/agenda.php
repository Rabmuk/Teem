<?php 	require_once "./headerNav.php";	
?>
<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
    <title>Teem - Agenda</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/agenda.css" />
    <script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
</head>
<body>
<div id = "wrapper">
	<div class="row">
		<div class="large-12 columns colorback">
			<h1 class= "meetingName">Web Science Meeting Agenda</h1>
			<p class= "desiredOutcome">Desired outcome: TO BEAT THE OTHER SCHEDULING TEAM >:D</p>
		</div>
	</div>
	<!--headings-->
	<div class="row">
		<div class="large-12 columns">
			<br><h3 class = "heading">Introduction</h3>
			<p class = "inline right">25 minutes</p>
			<p>Alex Kumbar</p>
		</div>
	</div>
	<!--topics, attachments-->
	<div class="row">
		<div class="large-6 columns">
			<h5 class= "heading">Topics to Cover</h5>
			<textarea rows="4" onFocus="if(this.value=='Enter topics here.')this.value='';">Enter topics here.</textarea>
			<input type="submit" name="savetopics" value="Save" />
		</div>
	</div>
</div>

<!--don't worry about this-->
<br><br><br><br><br>

</body>
</html>
<?php

	require_once "./bottomNav.php";

?>

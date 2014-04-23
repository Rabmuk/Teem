<?php
session_start();
foreach (glob("classes/*.php") as $filename)
{
	include $filename;
}

if (isset($_SESSION['email'])){
	$user = new User($_SESSION['email']);
}

if (isset($_GET['id'])) {
	$meeting = new Meeting($_GET['id']);
}

if(!$user->exists() || !$meeting->exists() || !$meeting->checkMember($user->getID())) {
	header("Location: ./index.php");
}

require_once "./headerNav.php";	
?>
<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<title>Teem - Agenda</title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/agenda.css" />
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body>
	<div id = "wrapper">
		<div class="row">
			<div class="large-12 columns">
				<h1 class= "meetingName"><?php echo $meeting->getTitle(); ?></h1>
				<p class= "desiredOutcome">Desired outcome: <?php echo $meeting->getDescription(); ?></p>
			</div>
		</div>
		<!--begin one person's section-->
		<!--headings-->
		<?php 
		$agendaItems = $meeting->getAgendaItems();
		foreach($agendaItems as $agendaItem){
			?>
			<div class="row">
				<div class="large-12 columns">
					<br><h3 class = "heading">Introduction</h3>
					<p class = "inline right"><?php echo $agendaItem->getTime(); ?> minutes</p>
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
				<div class="large-6 columns">
					<h5 class= "heading">Attachments</h5>
					<input type="submit" name="uploadfile" value="Upload File" />
					<input type="submit" name="savetopics" value="Save" />
				</div>
			</div>
			<center><hr style="width:80%;"></center>
			<?php 
		}
		?>
		
		<!--end one person's section-->
		<!--begin one person's section-->
		<!--headings-->
		<!-- <div class="row">
			<div class="large-12 columns">
				<br><h3 class = "heading">Colors and stuff</h3>
				<p class = "inline right">15 minutes</p>
				<p>Hayley Schluter</p>
			</div>
		</div> -->
		<!--topics, attachments-->
		<!-- <div class="row">
			<div class="large-6 columns">
				<h5 class= "heading">Topics to Cover</h5>
				<textarea rows="4" onFocus="if(this.value=='Enter topics here.')this.value='';">Enter topics here.</textarea>
				<input type="submit" name="savetopics" value="Save" />
			</div>
			<div class="large-6 columns">
				<h5 class= "heading">Attachments</h5>
				<input type="submit" name="uploadfile" value="Upload File" />
				<input type="submit" name="savetopics" value="Save" />
			</div>
		</div>
		<center><hr style="width:80%;"></center> -->
		<!--end one person's section-->

	</div>

	<!--don't worry about this-->
	<br><br><br><br><br>

</body>
</html>
<?php

require_once "./bottomNav.php";

?>

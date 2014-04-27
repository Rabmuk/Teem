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

if (isset($_POST['savetopics']) && $_POST['savetopics'] == 'Save') {
	addTopicsToItem($_POST['item_id'], $_POST['topics']);
}

if (isset($_POST['addItem']) && $_POST['addItem'] == "Submit") {
	addItemToMeeting($meeting->getID(), $_POST['heading'], $_POST['time'], $_POST['presenter']);
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
					<br><h3 class = "heading"><?php echo $agendaItem->getHeading(); ?></h3>
					<p class = "inline right"><?php echo $agendaItem->getTime(); ?> minutes</p>
					<p><?php echo $agendaItem->getPresenter()->getName(); ?></p>
				</div>
			</div>
			<!--topics, attachments-->
			<div class="row">
				<div class="large-6 columns">
					<h5 class= "heading">Topics to Cover</h5>
					<ul>
						<?php 
						$topics = $agendaItem->getTopics();
						foreach ($topics as $topic) {
							echo "<li>" . $topic . "</li>";
						}
						?>
					</ul>
					<?php 
					$isPresenter = $user->isUser($agendaItem->getPresenter());
					if ($isPresenter) {
						?>
						<form method="post" action=<?php echo '"?id=' . $_GET['id'] . '"'; ?>>
							<input type="hidden" name="item_id" value=<?php echo '"' . $agendaItem->getID() . '"'; ?>>
							<textarea name="topics" rows="4" onFocus="if(this.value=='Add topics here.')this.value='';">Add topics here.</textarea>
							<input type="submit" name="savetopics" value="Save" />
						</form>
						<?php
					}
					?>
				</div>
				<div class="large-6 columns">
					<h5 class= "heading">Attachments</h5>
					<?php
					if ($isPresenter) {
						?>
						<input type="submit" name="uploadfile" value="Upload File" />
						<input type="submit" name="savetopics" value="Save" />
						<?php
					}
					?>
				</div>
			</div>
			<center><hr style="width:80%;"></center>
			<?php 
		}
		?>

		<a href="#" data-reveal-id="myModal" class="button exapand" data-reveal>Add meeting item</a>
		
		<div id="myModal" class="reveal-modal small" data-reveal>
			<h1>Add meeting item</h1>
			<form method="post" action=<?php echo '"?id=' . $_GET['id'] . '"'; ?>>
				<input type="text" name="heading" placeholder="Enter item heading">
				<input type="number" name="time" placeholder="Enter allotted minutes">
				<input type="email" name="presenter" placeholder="Enter presentor's email">
				<input type="submit" name="addItem" value="Submit" class="button small expand"></input>
				<a class="close-reveal-modal">&#215;</a>
				
			</form>
		</div>
	</div>

	<!--don't worry about this-->
	<br><br><br><br><br>

	<script type="text/javascript" src="js/foundation/foundation.js"></script>
    <script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
    <script>
    $(document).foundation();
    </script>

</body>
</html>
<?php

require_once "./bottomNav.php";

?>

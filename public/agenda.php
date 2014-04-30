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

$reload = false;

if (isset($_POST['topics'])) {
	addTopicsToItem($_POST['item_id'], $_POST['topics']);
	$reload = true;
}

if (isset($_POST['clearTopics'])) {
	$item = new agendaItem($_POST['item_id']);
	$item->clearTopics();
	$reload = true;
}

if (isset($_POST['addItem']) && $_POST['addItem'] == "Submit") {
	addItemToMeeting($meeting->getID(), $_POST['heading'], $_POST['time'], $_POST['presenter']);
	$reload = true;
}

if (isset($_POST['savefile']) && $_POST['savefile'] == 'Submit') {
	if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	} else {
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		$randomName = hash('sha256', uniqid(mt_rand(), true));
		move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $randomName . '.' . $extension);
		addFileToItem($_POST['item_id'], $temp[0], $randomName . '.' . $extension);
	}
	$reload = true;
}

if (isset($_POST['newtask'])) {
	$meeting->addActionItem($_POST['id_user'], $_POST['newtask']);
	$reload = true;
}

if (isset($_POST['clearActions'])) {
	$meeting->clearActionItem($_POST['id_user']);
	$reload = true;
}

if ($reload) {
	echo '<script>window.location.reload()</script>';
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
	<script src="js/agenda.js"></script>
</head>


<body>


	<div class="wrapper">
		
		<!-- Meeting name and desire outcome -->
		<div class="row">
			<div class="large-9 columns" id="desiredOutcomes">
				<h1 class= "meetingName"><?php echo $meeting->getTitle(); ?></h1>
				<p class= "desiredOutcome">Desired outcome: <?php echo $meeting->getDescription(); ?></p>
			</div>

		</div>





<<<<<<< HEAD
=======


>>>>>>> d89657c99ff8d41e616a21e7b7512ab281b72ff7
		<!-- Actual agenda, and next actions -->
		<div class="row">
			<div class="large-9 columns" id="meetingTasks">
				

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

						<div class="row">
							<a href="#" data-reveal-id="myModal" class="button exapand" data-reveal>Add meeting item</a>
						</div>

				
			

			</div>
<<<<<<< HEAD
=======

			

			

>>>>>>> d89657c99ff8d41e616a21e7b7512ab281b72ff7

			<!-- Next Actions -->
			<div class="large-3 columns" id="nextActions">
				<div class="actionItems">
						<!-- Each individual action item list -->
						<h3>Action Items</h3>
						<?php 
						$members = $meeting->getMemberArray();
						foreach ($members as $member) {
							?>
							<div class="row">
								<!-- meeting attendee's name -->
								<h4 class="memberName"><?php echo $member->getName(); ?></h4>
								<!-- List of existing tasks -->
								<ul class="tasks">
									<?php
									foreach ($member->getActionItems($meeting->getID()) as $action) {
										echo '<li>' . $action->getAction() . '</li>';
									}
									?>
								</ul>
								<!-- Add a new task -->
								<!-- Hitting enter will input the form. Javascript located in agenda.js -->
								<form method="post">
									<input type="text" name="newtask" placeholder="New Task">
									<input type="hidden" name="id_user" value="<?php echo $member->getID(); ?>">
								</form>
								<form method="post">
									<input type="submit" name="clearActions" value="Clear" />
									<input type="hidden" name="id_user" value="<?php echo $member->getID(); ?>">
								</form>




							</div>

							<?php
						}
						?>

					</div>

			</div>
<<<<<<< HEAD




			

		</div>
=======

			
>>>>>>> d89657c99ff8d41e616a21e7b7512ab281b72ff7

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

<?php
session_start();
// incluces all support files from classes
foreach (glob("classes/*.php") as $filename)
{
	include $filename;
}

// creates user based on session variables
if (isset($_SESSION['email'])){
	$user = new User($_SESSION['email']);
}

//creates meeting based on get request
if (isset($_GET['id'])) {
	$meeting = new Meeting($_GET['id']);
}

//if user or meeting is invalid or if the user is not a member of the given meeting, redirects to index.php
if(!$user->exists() || !$meeting->exists() || !$meeting->checkMember($user->getID())) {
	header("Location: ./index.php");
}

// does the page need to reload
$reload = false;

//add a topic
if (isset($_POST['topics'])) {
	addTopicsToItem($_POST['item_id'], $_POST['topics']);
	$reload = true;
}

//clear topics
if (isset($_POST['clearTopics'])) {
	$item = new agendaItem($_POST['item_id']);
	$item->clearTopics();
	$reload = true;
}

//only the owner can add new items
if (isset($_POST['addItem']) && $_POST['addItem'] == "Submit" && $meeting->checkOwner($user->getID())) {
	addItemToMeeting($meeting->getID(), $_POST['heading'], $_POST['time'], $_POST['presenter']);
	$reload = true;
}

//save a file and moves it to uploads giving it a random file name and remembering its real name in the database
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

// new task
if (isset($_POST['newtask'])) {
	$meeting->addActionItem($_POST['id_user'], $_POST['newtask']);
	$reload = true;
}

//clears tasks
if (isset($_POST['clearActions'])) {
	$meeting->clearActionItem($_POST['id_user']);
	$reload = true;
}

//only the owner can email out the action items
if (isset($_POST['emailActionItems']) && $meeting->checkOwner($user->getID())) {
	$meeting->emailActionItems();
	$reload = true;
}

//if the client refreshes it wont prompt them to resubmit the form post
if ($reload) {
	echo '<script>window.location.reload()</script>';
}

?>
<!doctype HTML>
<head>
	<!--links-->
	<meta charset="utf-8" />
	<title>Teem - Agenda</title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/agenda.css" />
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="js/agenda.js"></script>
</head>
<body>

<!--header-->
	<?php
	require_once "./headerNav.php";	
	?>

	<!-- Wraps around all content for proper position of footer -->
	<div class="wrapper">

		
		<!-- Meeting name and desired outcome -->
		<div class="row" >
			<div class="large-6 columns">
				<h1 class= "meetingName"><?php echo $meeting->getTitle(); ?></h1>
				<p class= "desiredOutcome">Desired outcome: <?php echo $meeting->getDescription(); ?></p>
			</div>
		</div>

		



		<!-- Agenda body -->
		<div class="row">
			<div class="large-8 columns" id="agendaBody">
				<?php 
				$agendaItems = $meeting->getAgendaItems();
				//for every item on the agenda, make one of these:
				foreach($agendaItems as $agendaItem){
					?>
					<div class="row">
						<div class="large-12 columns">
							<!--name of topic, person responsible, amount of time-->
							<br><h3 class = "heading bigyo"><?php echo $agendaItem->getHeading(); ?></h3>
							<p class = "inline right"><?php echo $agendaItem->getTime(); ?> minutes</p>
							<p><?php echo $agendaItem->getPresenter()->getName(); ?></p>
						</div>
					</div>
					<!--topics, attachments-->
					<div class="row needsbottomborder">
						<div class="large-6 columns">
							<h5 class= "heading">Topics to Cover</h5>
							<ul>
								<?php 
								$topics = $agendaItem->getTopics();
								//for every topic added, make it part of the list
								foreach ($topics as $topic) {
									echo "<li>" . $topic . "</li>";
								}
								?>
							</ul>
							<?php 
							//the presenter of a agenda item can add and clear topics
							$isPresenter = $user->isUser($agendaItem->getPresenter());
							if ($isPresenter) {
								?>
								<!--if the current user is the presenter, they can add topics-->
								<form method="post">
									<input type="text" name="topics" placeholder="New Topic">
									<input type="hidden" name="item_id" value="<?php echo $agendaItem->getID(); ?>">
								</form>
								<form method="post">
									<!--or get rid of them-->
									<input type="submit" name="clearTopics" value="Clear" />
									<input type="hidden" name="item_id" value="<?php echo $agendaItem->getID(); ?>">
								</form>
								<?php
							}
							?>
						</div>

						<div class="large-6 columns">
							<!--attachments can be added by the person who 'owns' that topic, but not others-->
							<h5 class= "heading">Attachments</h5>
							<ul>
								<?php
								// displaying files
								$files = $agendaItem->getFiles();
								foreach ($files as $file) {
									?>
									<!--and upload files!-->
									<a href="uploads/<?php echo $file->getLocation(); ?>" target="_blank"><?php echo $file->getName(); ?></a>

									<?php
								}
								?>
							</ul>
							<?php
							// only the presenter can upload files for that item
							if ($isPresenter) {
								?>
								<br>
								<form method="post" enctype="multipart/form-data">
									<!--uploading files form-->
									<input type="hidden" name="item_id" value=<?php echo '"' . $agendaItem->getID() . '"'; ?>>
									<label for="file">Filename:</label>
									<input type="file" name="file" id="file"><br>
									<input type="submit" name="savefile" value="Submit" id="filenamesubmit">
								</form>

								<?php
							}
							?>
						</div>

					</div>



					<?php 
				}
				?>

				<br>
				<br>

				<?php
				//owner option
				if ($meeting->checkOwner($user->getID())) {
					?>
					<div class="row">
						<!--if the user is the owner/creator of the meeting, they can assign people to topics and give them a specific amount of time-->
						<a href="#" id = "addmeetingitembutton" data-reveal-id="myModal" class="button exapand" data-reveal>Add meeting item</a>
					</div>
					<form method="post">
						<!--emails action items to users-->
						<input type="submit" name="emailActionItems" value="Email Action Items">
					</form>
					<?php 
				}
				?>

				<!--actually adding meeting items popup from clicking the button 'add meeitng item'-->
				<div id="myModal" class="reveal-modal small" data-reveal>
					<h1>Add meeting item</h1>
					<form method="post" action=<?php echo '"?id=' . $_GET['id'] . '"'; ?>>
						<input type="text" name="heading" placeholder="Enter item heading">
						<input type="number" name="time" placeholder="Enter allotted minutes">
						<!-- <input type="email" name="presenter" placeholder="Enter presentor's email"> -->
						<!--select member for that topic-->
						<label>Select meeting attendee
							<select name="presenter" id = "makegoodborder">
								<?php
								$members = $meeting->getMemberArray();
								foreach ($members as $member) {
									echo '<option value="' . $member->getEmail() . '">' . $member->getName() . '</option>';	
								}
								?>
							</select>

						</label>
						<!--submit button-->
						<center><input type="submit" name="addItem" value="Submit" class="button small expand"></input></center>
						<a class="close-reveal-modal">&#215;</a>

					</form>
				</div>
			</div>
			<!--start next actions-->
			<div class="large-4 columns" id="nextActions">
				<!-- Each individual action item list -->
				<div class="row">
					<h3 id = "actionitemstitle">Action Items</h3>
				</div>
				<?php 
				// actoin items
				$members = $meeting->getMemberArray();
				foreach ($members as $member) {
					?>
					<div class="row">
						<!-- meeting attendee's name -->
						<h5 class="memberName"><?php echo $member->getName(); ?></h5>
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



		


	</div>
	

	<!--don't worry about this-->
	<br><br><br><br><br>
	<!-- Needed for the reveal modeal in Foundation 5 -->
	<script type="text/javascript" src="js/foundation/foundation.js"></script>
	<script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
	<script>
	$(document).foundation();
	</script>

</body>
</html>
<!--footer, yo-->
<?php

require_once "./bottomNav.php";

?>

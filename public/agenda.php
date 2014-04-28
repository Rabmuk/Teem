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
	<script src="agenda.js"></script>
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
				<div class="large-10 columns">
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
					<ul>
						<?php
						$files = $agendaItem->getFiles();
						foreach ($files as $file) {
							?>
							<a href="uploads/<?php echo $file->getLocation(); ?>" target="_blank"><?php echo $file->getName(); ?></a>

							<?php
						}
						?>
					</ul>
					<?php
					if ($isPresenter) {
						?>

						<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="item_id" value=<?php echo '"' . $agendaItem->getID() . '"'; ?>>
							<label for="file">Filename:</label>
							<input type="file" name="file" id="file"><br>
							<input type="submit" name="savefile" value="Submit">
						</form>

						<?php
					}
					?>
				</div>

			</div>

			
			<center><hr style="width:80%;"></center>
			<?php 
		}
		?>
		<div class="row">
			<a href="#" data-reveal-id="myModal" class="button exapand" data-reveal>Add meeting item</a>
		</div>

		
		
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


	<!-- Action items *TODO* FOR ALEX-->
	<!-- It's a list of each member's name, with a list of their action items. Underneath it is the ability to add tasks -->
	
		<!-- Each individual action item list -->
		<div class="row actionItems">
			<div class="large-2 columns">
				<!-- meeting attendee's name -->
				<h3 class="memberName">Chris</h3>
				<!-- List of existing tasks -->
				<ul class="tasks">
				    <li>Write the next great novel.</li>
				    <li>Shovel snow</li>
				    <li>Juggle saws</li>
				    <li>Dance</li>
				</ul>
				<!-- Add a new task -->
				<!-- Hitting enter will input the form. Javascript located in agenda.js -->
				<form method="post">
					<input type="text" name="Newtask" placeholder="New Task">

				</form>
			</div>
		</div>

		<div class="row actionItems">
			<div class="large-2 columns">
				<h3 class="memberName">Candice</h3>
				<ul class="tasks">
				    <li>Peel an orange</li>
				    <li>Drink coffe</li>
				</ul>
				<!-- Add a new task -->
				<form method="post">
					<input type="text" name="Newtask" placeholder="New Task">

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

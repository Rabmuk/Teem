<?php 	
session_start();
$counter = 0;
// incluces all support files from the classes folder
foreach (glob("classes/*.php") as $filename)
{
  include $filename;
}

// creates user based on session variables
if (isset($_SESSION['email'])){
	$user = new User($_SESSION['email']);
}else{
	header("Location: ./index.php");
}

//save file, dd to group database, reload window
if(isset($_POST['submit'])){
  $id_owner = $user->getID();
  addGroupToDatabase($id_owner, $_POST['groupName'], $_POST['addMembers']);
  echo '<script>window.location.reload()</script>';
}
//header, yo
require_once "./headerNav.php";	
?>


<!doctype HTML>
<html class="no-js" lang="en">
<head>
  <!--links-->
  <meta charset="utf-8" />
  <title>My Profile - Home</title>
  <link rel="stylesheet" href="css/foundation.css" />
  <link rel="stylesheet" href="css/profile.css" />
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>


<body>
	<div class="wrapper" id="specialwrapperprofile">
   <div class="row">
    <div class="large-6 columns">
     <!--welcome message for user plus their name-->
     <h1 class="myProfile">Welcome, <?php echo $user->getFirstName(); ?>!</h1>
   </div>
   <div class="links large-3 columns">
     <!--create a group link that will open a little box to do so-->
     <a href="#" data-reveal-id="myModal" data-reveal>(+) Create a Group</a>
     <div id="myModal" class="reveal-modal small" data-reveal>
      <div id="createGroup">
       <!--create a group box-->
       <h1>Create a Group</h1>
       <form method="post" action="profile.php" id="addGroup">
        <!--add group name, members-->
        <label for="groupName">Group Name: </label><input id="groupName" type="text" name="groupName" />
        <label for="addMembers">Add Members*:</label><textarea id="addMembers" rows="4" cols="50" name="addMembers" form="addGroup"></textarea>
        <p>*Seperate group member e-mails by ','</p>
        <div class="row">
         <div class="large-12 columns">
          <!--button submits it-->
          <input name="submit" type="submit" value="Submit" />
        </div>
      </div>
    </form>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>
</div>
<div class="links large-3 columns">
 <!--create a meeting link that will open new page-->
 <a href="createmeeting.php">(+) Create a Meeting</a>
</div>
</div>
<div class="row">
  <div class="large-6 columns">
   <div class="boxcolumn">
    <!--user's list of groups they're currently in-->
    <h2 class="profileHeader">My Groups</h2>
    <?php 
    $results = $user->getGroups();
    //for every group:
    foreach ($results as $group) {
     ?>
     <h3> 
      <?php
      //if it's the owner, they can edit the group
      if ($group->checkOwner($user->getID())) {
        echo '<a href="editgroup.php?id=' . $group->getID() . '">';  
      }
      ?>
      <!--show group name, clicking on it will allow user to edit it-->
      <?php
      echo $group->getName(); 
      if ($group->checkOwner($user->getID())) {
        ?>
      </a>
      <?php
    }
    ?>
  </h3>
  <ul id="groupNames">
    <!--leader of group-->
    <li>Team Leader: <?php echo $group->getOwner()->getName(); ?></li>
    <!--all members of group-->
    <li>Members: 
     <?php 
     echo $group->getMemberNames();
     ?>
   </li>
 </ul>
 <!--divider between groups-->
 <hr class="profileDivide"></hr>
 <?php
}
?>
</div>
</div>
<div class="large-6 columns">
 <div class="boxcolumn">
  <!--upcoming meetings!-->
  <h2 class="profileHeader">Upcoming Meetings</h2>
  <?php 
  $results = $user->getMeetings();
  //for every meeitng:
  foreach ($results as $meeting) {
   ?>
  <!--date of meeting-->
   <h3 class="teamTitle"><?php echo $meeting->getDate(); ?></h3>
   <div class="row">
     <div class="large-2 columns">
      <!--time icon-->
      <img src="img/clock.png"></img>
    </div>
    <div class="large-10 columns">
      <!--time and title of meeitng-->
      <h4><?php echo $meeting->getTime(); ?> - <a href=<?php echo '"agenda.php?id=' . $meeting->getID() . '"'; ?>><?php echo $meeting->getTitle(); ?></a></h4>
    </div>
    <hr>
  </div>
  <?php
}
?>
</div>
</div>
</div>
<div class="push"></div>
</div>
</body>
<!--javascript links-->
<script type="text/javascript" src="js/foundation/foundation.js"></script>
<script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
<script>
$(document).foundation();
</script>
</html>
<!--footer, yo-->
<?php

require_once "./bottomNav.php";

?>

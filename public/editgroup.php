<?php 	
session_start();
foreach (glob("classes/*.php") as $filename)
{
  include $filename;
}

if (isset($_SESSION['email'])){
	$user = new User($_SESSION['email']);
}else{
	header("Location: ./index.php");
}

require_once "./headerNav.php";	
?>
<!doctype HTML>
<html>
 <body>
  <h1> Edit Group </h1>
  <div>
 <?php 
    $results = $user->getGroups();
    $arraycounter  = 0;
    foreach ($results as $group) {
     ?>
     <h3"teamTitle"> <?php echo $group->getName(); ?></h3>
     <ul id="groupNames">
      <li>Team Leader: <?php echo $group->getOwner()->getName(); ?></li>
      <li>Members: 
       <?php 
       echo $group->getMemberNames();
       ?>
       </li>
      </ul>
     <?php 
      }
       ?>
  </div> 
 </body>
</html>
<?php

require_once "./bottomNav.php";

?>
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
<head>
  <title>Edit Group</title>
  <link rel="stylesheet" href="css/foundation.css" />
  <link rel="stylesheet" href="css/editgroup.css"/>
</head>
 <body>
  <div id="wrapper">
    <div class="row">
      <div class="large-12 columns">
        <h1> Edit Group </h1>
      </div>
    </div>
    <?php 
      $results = $user->getGroups();
      $arraycounter  = 0;
      foreach ($results as $group) {
    ?>
    <form action="" method="post">
      <div class="row">
        <div class="small-3 columns">
          <label for="changeName" class="right inline">Change Group Name: </label>
        </div>
        <div class="small-9 columns">
          <input type="text" id="changeName" name="changeName" value="<?php echo $group->getName(); ?>">
        </div>
      </div>
      <?php } ?>
      <div class="row">
        <div class="small-3 columns">
          <label for="addMember" class="right inline">Add Members</label>
        </div>
        <div class="small-9 columns">
          <input type="text" id="addMember" name="addMember" placeholder="Enter Member Name">
        </div>
      </div>
      <div class="row">
        <div class="small-3 columns">
          <label for="deleteMemembers" class="right inline">Delete Members</label>
        </div>
        <div class="small-9 columns">
          <ul id="deleteMembers">
          <?php
          $members = $group->getMemberArray();
          $counter = 0;
          foreach ($members as $value) {
            echo "<li><input id='deleteMember[$counter]' type='checkbox'><label for='deleteMember[$counter]'>$value</label></input></li>";
            $counter++;
          }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="small-3 columns"></div>
        <div class="small-9 columns">
          <input id="deleteAcc" type="checkbox"><label for="deleteAcc">Delete Group?</label></input>
        </div>
      </div>
      <div class="row">
        <div class="small-3 columns">
          <input type="submit" name="submit" value="Save" class="button small expand"></input>
        </div>
      </div>
    </form>
  </div>
 </body>
</html>

<?php
require_once "./bottomNav.php";
?>
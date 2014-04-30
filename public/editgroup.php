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

if(isset($_POST['submit'])){
  $group = new Group($_GET['id']);
  $memberarray = $group->getMemberArrayID();
  $groupid = $group->getID();
  $groupname = $group->getName();
  $email_user = $user->getEmail();

  if(isset($_POST['deleteAcc'])){

    //$id_owner = $user->getID();
    //deleteGroup($id_owner);


    //header("Location: ./profile.php");
  }

  $counter = 0;
  foreach ($memberarray as $value) {
    echo $memberarray[$counter];
    echo "\n";
    if(isset($_POST["deleteMember[{$counter}]"])){
      echo "YOLO!";
      $id_member = $value;
      deleteMember($id_member);
    }
    $counter++;
  }

  $newgroupname = $_POST['changeName'];
  if($newgroupname != $groupname){
    changeGroupName($groupid, $newgroupname);
  }

  $newmember = $_POST['addMember'];
  if($newmember != ''){
    addMember($newmember, $groupid);
    echo $id_owner;
  }
}

if(isset($_POST['deleteAcc']) && $_POST['deleteAcc'] == "Yes"){
    $id_owner = $user->getID();
    deleteGroup($id_owner);

    header("Location: ./profile.php");
  }

if(isset($_POST['deleteAcc']) && $_POST['deleteAcc'] == "No"){
    header("Location: ./editgroup.php");
  }

require_once "./headerNav.php";	
?>
<!doctype HTML>
<html>
<head>
  <title>Edit Group</title>
  <link rel="stylesheet" href="css/foundation.css" />
  <link rel="stylesheet" href="css/editgroup.css"/>
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
 <body>
  <div id="wrapper">
    <div class="row">
      <div class="large-12 columns">
        <h1> Edit Group </h1>
      </div>
    </div>
    <?php 
      if (isset($_GET['id'])) {
        $group = new Group($_GET['id']);
      }
    ?>
    <form action=<?php echo '"?id=' . $_GET['id'] . '"';?> method="post">
      <div class="row">
        <div class="small-3 columns">
          <label for="changeName" class="right inline">Change Group Name: </label>
        </div>
        <div class="small-9 columns">
          <input type="text" id="changeName" name="changeName" value="<?php echo $group->getName(); ?>">
        </div>
      </div>
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
            echo "<li><input id='deleteMember[{$counter}]' name='deleteMember[{$counter}]' type='checkbox'><label for='deleteMember[{$counter}]'>$value</label></input></li>";
            $counter++;
          }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="small-8 columns"><p></p></div>
        <div class="small-2 columns">
          <a href="#" data-reveal-id="myModal" class="button expand" data-reveal>Delete Group</a>
        </div>
        <div class="small-2 columns">
          <input type="submit" name="submit" value="Save" class="button small"></input>
        </div>
      </div>
      <div id='myModal' class='reveal-modal small' data-reveal>
        <p class="text-center">Are you sure you want to delete your group?</p>
        <div class="row">
          <div class="large-3 columns"><p></p></div>
          <div class="large-3 columns">
            <input type="submit" name="deleteAcc" value="Yes" class="button small"></input>
          </div>
          <div class="large-3 columns">
            <input type="submit" name="deleteAcc" value="No" class="button small"></input>
          </div>
        <a class='close-reveal-modal'>&#215;</a>
      </div>
    </form>
  </div>
  <script type="text/javascript" src="js/foundation/foundation.js"></script>
  <script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
  <script> $(document).foundation(); </script>
 </body>
</html>

<?php
require_once "./bottomNav.php";
?>